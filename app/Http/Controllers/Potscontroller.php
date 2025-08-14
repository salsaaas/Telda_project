<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;   // pakai tabel products
use App\Models\Category;

class PotsController extends Controller
{
    /**
     * Halaman Kalkulator Pots
     * - Menampilkan kategori: INDIBIZ & ADDON
     * - Tidak memuat semua produk (produk diambil via AJAX Select2)
     */
    public function index(Request $request)
    {
        // Kategori yang relevan untuk Pots
        $categories = Category::whereIn('nama_category', ['INDIBIZ', 'ADDON'])->get();

        // (opsional) ?category=INDIBIZ untuk preselect di UI
        $selectedCategory = $request->get('category');

        // Untuk badge "Total Produk" saja, tanpa berat (ambil id saja)
        $productsCountQuery = Product::whereHas('category', function ($q) {
            $q->whereIn('nama_category', ['INDIBIZ', 'ADDON']);
        });

        if (!empty($selectedCategory)) {
            $productsCountQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('nama_category', $selectedCategory);
            });
        }

        // biar di Blade bisa pakai count($products) untuk badge
        $products = $productsCountQuery->select('id')->get();

        return view('pots.index', compact('categories', 'products', 'selectedCategory'));
    }

    /**
     * Endpoint AJAX Select2 khusus Pots
     * GET /pot-products/by-category?category_id=...&q=...
     * Return: [{ id, text, price }]
     */
    public function productsByCategory(Request $request)
    {
        $categoryId = $request->query('category_id');
        $search     = $request->query('q');

        // Tanpa kategori -> kembalikan kosong (hindari campur aduk)
        if (empty($categoryId)) {
            return response()->json([]);
        }

        // Ambil produk per kategori + pencarian (kalau ada)
        // Hindari duplikasi nama produk dengan unique('nama_product') di collection.
        $items = Product::select('id', 'nama_product', 'price')
            ->where('category_id', $categoryId)
            ->when($search, function ($q) use ($search) {
                $q->where('nama_product', 'like', "%{$search}%");
            })
            ->orderBy('nama_product')
            ->get()
            ->unique('nama_product')     // anti dobel di sisi collection
            ->values()
            ->map(function ($p) {
                return [
                    'id'    => $p->id,
                    'text'  => $p->nama_product,
                    'price' => (float) $p->price,
                ];
            });

        return response()->json($items);
    }
}
