<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productpots;
use App\Models\Categorypots;



class PotsController extends Controller
{
public function index()
{
   
        $categories = \App\Models\Category::whereIn('nama_category', [
                'INDIBIZ',
                'ADDON',
            ])->get(); 
        
            // Tetap ambil semua produk
            $products = \App\Models\Product::all(); 
            
            return view('nonpots.index', compact('categories', 'products'));
        }
}

