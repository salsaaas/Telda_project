<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NonpotsController extends Controller
{
    public function index()
    {
        // Ambil data categories dan products dari database
            // Ambil hanya kategori tertentu
            $categories = \App\Models\Category::whereIn('nama_category', [
                'ASTINET',
                'IP TRANSIT',
                'METRO-E',
            ])->get(); 
        
            // Tetap ambil semua produk
            $products = \App\Models\Product::all(); 
            
            return view('nonpots.index', compact('categories', 'products'));
        }
        

    public function printPdf(Request $request)
{
    // payload bisa berupa hidden input 'payload' (JSON string)
    $raw = $request->input('payload');
    $data = is_string($raw) ? (json_decode($raw, true) ?: []) : [];
    $title   = $data['title'] ?? 'Quotation';
    $inItems = $data['items'] ?? [];

    // Ambil nama kategori & produk dari DB untuk dipetakan
    
    $prodMap = \App\Models\Product ::pluck('nama_product',  'id')->toArray();
    $catMap = \App\Models\Category::pluck('nama_category', 'category_id')->toArray(); // perbaikan key

    $items = [];
    foreach ($inItems as $it) {
        $categoryId = $it['category_id'] ?? null;
        $items[] = [
            'category_name' => $it['category_name'] 
                               ?? ($categoryId && isset($catMap[$categoryId]) ? $catMap[$categoryId] : '-'),
            'product_name'  => $it['product_name'] ?? ($prodMap[$it['product_id'] ?? null] ?? '-'),
            'schema'        => $it['schema'] ?? ($it['skema'] ?? ''),
            'qty'           => (int) ($it['qty'] ?? 1),
            'duration'      => (int) ($it['duration'] ?? 1),
            'price'         => (float) ($it['price'] ?? 0),
            'discount'      => (float) ($it['discount'] ?? 0),
            'otc_category'  => $it['otc_category'] ?? ($it['skema'] ?? ''),
            'otc_price'     => (float) ($it['otc_price'] ?? ($it['otc'] ?? 0)),
            'otc_discount'  => (float) ($it['otc_discount'] ?? ($it['disc_otc'] ?? 0)),
            'ppn_rate'      => isset($it['ppn_rate']) ? (int)$it['ppn_rate'] : null,
        ];
    }

    // Grand total (pakai rumus yang sama dengan Blade agar konsisten)
    $grandTotal = 0;
    foreach ($items as $it) {
        $line = ($it['price'] * $it['qty'] * $it['duration']) * (1 - $it['discount']/100);
        $line += $it['otc_price'] * (1 - $it['otc_discount']/100);
        $grandTotal += $line;
    }

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('nonpots.pdf', [
        'title'        => $title,
        'items'        => $items,
        'grand_total'  => $grandTotal,
        'generated_at' => now()->format('d/m/Y H:i:s'),
    ])->setPaper('A4', 'landscape');

    return $pdf->download('Kalkulator_Paket_'.str_replace(' ', '_', $title).'_'.now()->format('Ymd_His').'.pdf');
}



    public function save(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.category_name' => 'required|string',
            'items.*.product_name' => 'required|string',
            'items.*.otc_category' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.otc' => 'required|numeric|min:0',
            'items.*.duration' => 'required|integer|min:1',
        ]);

        try {
            $title = $request->input('title');
            $items = $request->input('items');
            $grandTotal = 0;

            // Proses setiap item
            $processedItems = [];
            foreach ($items as $item) {
                $price = (float) $item['price'];
                $otc = (float) $item['otc'];
                $duration = (int) $item['duration'];

                // Hitung semua nilai
                $priceWithPpn = $price * 1.11;
                $priceDuration = $priceWithPpn * $duration;
                $finalPriceNoPpn = ($price * $duration) + $otc;
                $finalPrice = $priceDuration + $otc;

                $processedItem = array_merge($item, [
                    'price_with_ppn' => $priceWithPpn,
                    'price_duration' => $priceDuration,
                    'final_price_no_ppn' => $finalPriceNoPpn,
                    'final_price' => $finalPrice,
                ]);

                $processedItems[] = $processedItem;
                $grandTotal += $finalPrice;
            }

            return response()->json([
                'success' => true,
                'message' => 'Kalkulasi berhasil disimpan',
                'data' => [
                    'title' => $title,
                    'items' => $processedItems,
                    'grand_total' => $grandTotal
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function calculate(Request $request)
    {
        // Method untuk menghitung secara real-time via AJAX
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.otc' => 'required|numeric|min:0',
            'items.*.duration' => 'required|integer|min:1',
        ]);

        $items = $request->input('items');
        $grandTotal = 0;
        $processedItems = [];

        foreach ($items as $item) {
            $price = (float) $item['price'];
            $otc = (float) $item['otc'];
            $duration = (int) $item['duration'];

            // Perhitungan
            $priceWithPpn = $price * 1.11;
            $priceDuration = $priceWithPpn * $duration;
            $finalPriceNoPpn = ($price * $duration) + $otc;
            $finalPrice = $priceDuration + $otc;

            $processedItems[] = [
                'price_with_ppn' => $priceWithPpn,
                'price_duration' => $priceDuration,
                'final_price_no_ppn' => $finalPriceNoPpn,
                'final_price' => $finalPrice,
            ];

            $grandTotal += $finalPrice;
        }

        return response()->json([
            'success' => true,
            'items' => $processedItems,
            'grand_total' => $grandTotal
        ]);
    }
}