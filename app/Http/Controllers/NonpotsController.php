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
            $raw = $request->input('payload');
            $data = is_string($raw) ? (json_decode($raw, true) ?: []) : [];
        
            $title   = $data['title'] ?? 'Quotation';
            $inItems = $data['items'] ?? [];
        
            $items = collect($inItems)->map(function ($it) {
                $product = \App\Models\Product::with('category', 'otcs')->find($it['product_id']);
                return [
                    'category_name' => $product->category->nama_category ?? '',
                    'product_name'  => $product->nama_product ?? '',
                    'schema'        => $it['schema'] ?? '',
                    'qty'           => (int) ($it['qty'] ?? 1),
                    'duration'      => (int) ($it['duration'] ?? 1),
                    'price'         => (float) ($it['price'] ?? $product->price ?? 0),
                    'discount'      => (float) ($it['discount'] ?? 0),
                    'otc_category'  => $product->otcs->first()->nama_otc ?? '',
                    'otc_price'     => (float) ($it['otc_price'] ?? $product->otcs->first()->price_OTC ?? 0),
                    'otc_discount'  => (float) ($it['otc_discount'] ?? 0),
                ];
            });
        
            // hitung grand total
            $grandTotal = $items->reduce(function ($carry, $it) {
                $line = ($it['price'] * $it['qty'] * $it['duration']) * (1 - $it['discount']/100);
                $line += $it['otc_price'] * (1 - $it['otc_discount']/100);
                return $carry + $line;
            }, 0);
        
            $pdf = Pdf::loadView('nonpots.pdf', [
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