<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;

class PotsController extends Controller
{
    public function index(Request $request)
    {
        // Kategori yang relevan untuk Pots (PAKAI SPASI: 'ADD ON')
        $categories = Category::whereIn('nama_category', ['INDIBIZ', 'ADDON'])
                        ->orderBy('nama_category')
                        ->get();

        // (opsional) ?category=INDIBIZ untuk preselect di UI
        $selectedCategory = $request->get('category');

        // Untuk badge "Total Produk"
        $productsCountQuery = Product::whereHas('category', function ($q) {
            $q->whereIn('nama_category', ['INDIBIZ', 'ADDON']);
        });

        if (!empty($selectedCategory)) {
            $productsCountQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('nama_category', $selectedCategory);
            });
        }

        $products = $productsCountQuery->select('id')->get();

        return view('pots.index', compact('categories', 'products', 'selectedCategory'));
    }

    public function productsByCategory(Request $request)
    {
        $categoryId = $request->query('category_id');
        $search     = $request->query('q');

        if (empty($categoryId)) {
            return response()->json([]);
        }

        $items = Product::select('id', 'nama_product', 'price')
            ->where('category_id', $categoryId)
            ->when($search, fn($q) => $q->where('nama_product', 'like', "%{$search}%"))
            ->orderBy('nama_product')
            ->get()
            ->unique('nama_product')
            ->values()
            ->map(fn($p) => [
                'id'    => $p->id,
                'text'  => $p->nama_product,
                'price' => (float) $p->price,
            ]);

        return response()->json($items);
    }

    public function printPdf(Request $request)
{
    $title = $request->input('calculationTitle', 'Kalkulator Pots');
    $inItems = json_decode($request->input('items', '[]'), true);

    // 🔹 Ambil nama produk & kategori dari database
    $prodMap = Product::pluck('nama_product', 'id')->toArray();
    $catMap  = Category::pluck('nama_category', 'category_id')->toArray();

    // 🔹 Proses item agar punya product_name & category_name
    $items = [];
    foreach ($inItems as $it) {
        $categoryId = $it['category_id'] ?? null;
        $items[] = [
            'category_name' => $it['category_name'] 
                               ?? ($categoryId && isset($catMap[$categoryId]) ? $catMap[$categoryId] : '-'),
            'product_name'  => $it['product_name'] 
                               ?? ($prodMap[$it['product_id'] ?? null] ?? '-'),
            'schema'        => $it['schema'] ?? ($it['skema'] ?? ''),
            'qty'           => (int) ($it['qty'] ?? 1),
            'duration'      => (int) ($it['duration'] ?? 1),
            'price'         => (float) ($it['price'] ?? 0),
            'discount'      => (float) ($it['discount'] ?? 0),
            'otc_category'  => $it['otc_category'] ?? ($it['skema'] ?? ''),
            'otc_price'     => (float) ($it['otc_price'] ?? ($it['otc'] ?? 0)),
            'otc_discount'  => (float) ($it['otc_discount'] ?? ($it['disc_otc'] ?? 0)),
        ];
    }

    // 🔹 Hitung Grand Total (biar konsisten sama versi nonpots)
    $grandTotal = 0;
    foreach ($items as $it) {
        $line = ($it['price'] * $it['qty'] * $it['duration']) * (1 - $it['discount'] / 100);
        $line += $it['otc_price'] * (1 - $it['otc_discount'] / 100);
        $grandTotal += $line;
    }

    // 🔹 Generate PDF
    $pdf = Pdf::loadView('pots.pdfpots', [
        'title'        => $title,
        'items'        => $items,
        'grand_total'  => $grandTotal,
        'generated_at' => now()->format('d/m/Y H:i:s'),
    ])->setPaper('a4', 'landscape');

    return $pdf->download(
        str_replace(' ', '_', $title) . '_' . now()->format('Ymd_His') . '.pdf'
    );
}
}
