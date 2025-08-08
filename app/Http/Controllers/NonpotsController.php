<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NonpotsController extends Controller
{
    public function index()
    {
        // Ambil data categories dan products dari database
        $categories = \App\Models\Category::all(); 
        $products = \App\Models\Product::all(); 
        
        return view('nonpots.index', compact('categories', 'products'));
    }

    public function printPdf(Request $request)
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

        $title = $request->input('title');
        $items = $request->input('items');
        $grandTotal = 0;

        // Proses setiap item untuk menghitung nilai-nilai yang diperlukan
        foreach ($items as &$item) {
            $price = (float) $item['price'];
            $otc = (float) $item['otc'];
            $duration = (int) $item['duration'];

            // Hitung harga dengan PPN (11%)
            $priceWithPpn = $price * 1.11;
            
            // Hitung harga x durasi (dengan PPN)
            $priceDuration = $priceWithPpn * $duration;
            
            // Hitung Final Price tanpa PPN: (price x duration) + OTC
            $finalPriceNoPpn = ($price * $duration) + $otc;
            
            // Hitung Final Price dengan PPN: (price with PPN x duration) + OTC
            $finalPrice = $priceDuration + $otc;

            // Tambahkan ke item array
            $item['price_with_ppn'] = $priceWithPpn;
            $item['price_duration'] = $priceDuration;
            $item['final_price_no_ppn'] = $finalPriceNoPpn;
            $item['final_price'] = $finalPrice;

            // Tambahkan ke grand total (menggunakan final price dengan PPN)
            $grandTotal += $finalPrice;
        }

        // Data untuk PDF
        $data = [
            'title' => $title,
            'items' => $items,
            'grand_total' => $grandTotal,
            'generated_at' => now()->format('d/m/Y H:i:s')
        ];

        // Generate PDF
        $pdf = PDF::loadView('nonpots.pdf', $data);
        
        // Set paper size dan orientasi
        $pdf->setPaper('A4', 'landscape');
        
        // Set nama file
        $filename = 'Kalkulator_Paket_' . str_replace(' ', '_', $title) . '_' . date('Ymd_His') . '.pdf';
        
        // Return PDF untuk download
        return $pdf->download($filename);
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