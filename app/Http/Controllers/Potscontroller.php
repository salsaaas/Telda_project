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
        $title   = $request->input('calculationTitle', 'Kalkulator Pots');
        $inItems = json_decode($request->input('items', '[]'), true) ?: [];

        // Peta nama untuk fallback kalau label tidak ikut terkirim
        $prodMap = Product::pluck('nama_product', 'id')->toArray();
        $catMap  = Category::pluck('nama_category', 'category_id')->toArray();

        $items = array_map(function ($it) use ($prodMap, $catMap) {
            $catId  = $it['category_id'] ?? null;
            $prodId = $it['product_id'] ?? null;

            $ppnDec = isset($it['ppn_rate_dec']) ? (float)$it['ppn_rate_dec']
                : (isset($it['ppn']) ? (float)$it['ppn'] : 0.0);

            $price    = (float)($it['price']    ?? 0);
            $duration = (int)  ($it['duration'] ?? 1);
            $qty      = (int)  ($it['qty']      ?? 1);
            $otc      = (float)($it['otc_price'] ?? ($it['otc'] ?? 0));

            // Recompute jika tidak ada di payload
            $price_with_ppn     = $it['price_with_ppn']     ?? ($price * (1 + $ppnDec));
            $price_duration     = $it['price_duration']     ?? ($price * $duration);
            $final_price_no_ppn = $it['final_price_no_ppn'] ?? ($price_duration + $otc);
            $final_price        = $it['final_price']        ?? ($final_price_no_ppn * (1 + $ppnDec)); // PPN juga untuk OTC

            return [
                'category_id'   => $catId,
                'category_name' => $it['category_name'] ?? ($catId && isset($catMap[$catId]) ? $catMap[$catId] : '-'),
                'product_id'    => $prodId,
                'product_name'  => $it['product_name']  ?? ($prodId && isset($prodMap[$prodId]) ? $prodMap[$prodId] : '-'),

                'price'         => $price,
                'duration'      => $duration,
                'qty'           => $qty,

                'otc_category'  => $it['otc_category'] ?? '-',
                'otc_price'     => $otc,

                'ppn_rate_dec'  => $ppnDec,
                'ppn_rate_pct'  => $it['ppn_rate_pct'] ?? ($ppnDec * 100),

                'price_with_ppn'     => (float)$price_with_ppn,
                'price_duration'     => (float)$price_duration,
                'final_price_no_ppn' => (float)$final_price_no_ppn,
                'final_price'        => (float)$final_price,
            ];
        }, $inItems);

        $grandTotal = array_reduce($items, fn($a, $r) => $a + (float)$r['final_price'], 0.0);

        // Kirim ke view
        return Pdf::loadView('pots.pdfpots', [
            'title'        => $title,
            'items'        => $items,
            'grand_total'  => $grandTotal,
            'generated_at' => now()->format('d/m/Y H:i:s'),
        ])->setPaper('a4', 'landscape')
        ->download(str_replace(' ', '_', $title) . '_' . now()->format('Ymd_His') . '.pdf');
    }

}
