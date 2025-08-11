<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class Potscontroller extends Controller
{
        public function index(Request $request)
        {
            // Ambil kategori yang relevan
            $categories = Category::whereIn('nama_category', ['INDIBIZ', 'ADDON'])->get();
        
            // Ambil input kategori yang dipilih dari request (GET parameter)
            $selectedCategory = $request->get('category'); // contoh: 'INDIBIZ'
        
            // Ambil produk berdasarkan kategori yang dipilih
            $products = Product::whereHas('category', function ($query) use ($selectedCategory) {
                $query->whereIn('nama_category', ['INDIBIZ', 'ADDON']);
        
                if ($selectedCategory) {
                    $query->where('nama_category', $selectedCategory);
                }
            })->get();
        
            return view('pots.index', compact('categories', 'products', 'selectedCategory'));
        }
}       