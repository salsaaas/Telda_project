<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productpots;
use App\Models\Categorypots;



class PotsController extends Controller
{
public function index()
{
   
        $products = Productpots::all();
        $categories = Categorypots::all();

        return view('pots.index', compact('products', 'categories'));
    
}
}
