<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class Potscontroller extends Controller
{  public function index(Request $request)
    {
        // Ambil kategori yang hanya INDIBIZ dan ADDON
        $categories = Category::whereIn('nama_category', ['INDIBIZ', 'ADDON'])->get();

        // Ambil kategori yang dipilih dari dropdown filter (jika ada)
        $selectedCategory = $request->get('category');

        $products = Product::whereHas('category', function ($query) use ($selectedCategory) {
                if (!empty($selectedCategory)) {
                    $query->where('nama_category', $selectedCategory);
                } else {
                    $query->whereIn('nama_category', ['INDIBIZ', 'ADDON']);
                }
            })
            ->selectRaw('MIN(id) as id, nama_product, MIN(category_id) as category_id')
            ->groupBy('nama_product')
            ->orderBy('nama_product', 'asc')
            ->get();

        // Pastikan data dikirim ke view
        return view('pots.index', compact('categories', 'products', 'selectedCategory'));
    }
}
