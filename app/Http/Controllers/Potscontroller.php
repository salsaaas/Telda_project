<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
}
