<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // =========================
    // CRUD & utility existing
    // =========================
    public function index()
    {
        $products = Product::with(['category', 'otcs'])->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,category_id',
            'nama_product' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
        ]);

        $product = Product::create($request->only('category_id', 'nama_product', 'price'));

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $product->load('category')
        ], 201);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'otcs'])->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'category_id'  => 'required|exists:categories,category_id',
            'nama_product' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
        ]);

        $product->update($request->only('category_id', 'nama_product', 'price'));

        return response()->json([
            'message' => 'Product updated successfully',
            'data'    => $product->load('category')
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function calculatePrice(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'otc_id'   => 'required|exists:otc,id_OTC',
            'duration' => 'required|integer|min:1',
            'ppn_rate' => 'nullable|numeric|min:0|max:1',
        ]);

        $totalPrice = $product->calculateTotalPrice(
            $request->otc_id,
            $request->duration,
            $request->ppn_rate ?? 0.11
        );

        if ($totalPrice === null) {
            return response()->json(['message' => 'Invalid OTC selected'], 400);
        }

        return response()->json([
            'product'     => $product->load('category'),
            'otc_id'      => $request->otc_id,
            'duration'    => $request->duration,
            'ppn_rate'    => $request->ppn_rate ?? 0.11,
            'total_price' => $totalPrice
        ]);
    }

    // =========================
    // NEW: Endpoint ramah Select2
    // GET /products/by-category?category_id=1&q=inet
    // ATAU /products/by-category?category=INDIBIZ&q=inet
    // =========================
    public function byCategory(Request $request)
    {
        $categoryId = $request->query('category_id');
        $category   = $request->query('category'); // nama kategori (mis. INDIBIZ)
        $search     = $request->query('q');

        // Jika user kirim 'category' (nama), konversi ke category_id
        if (!$categoryId && $category) {
            $categoryId = Category::where('nama_category', $category)  // sesuaikan kolom nama kategori
                                  ->orWhere('category_name', $category) // fallback jika kolommu bernama lain
                                  ->value('category_id');
        }

        $q = Product::query()->select('id', 'nama_product', 'category_id');

        if ($categoryId) {
            $q->where('category_id', $categoryId);
        }

        if (!empty($search)) {
            $q->where('nama_product', 'like', "%{$search}%");
        }

        $items = $q->orderBy('nama_product')
                   ->distinct('nama_product') // ANTI-DOBEL
                   ->get()
                   ->map(fn($p) => ['id' => $p->id, 'text' => $p->nama_product]);

        return response()->json($items);
    }

    // =========================
    // Legacy (tetap boleh dipakai)
    // GET /products/category/{categoryId}
    // =========================
    public function getByCategory(Request $request, $categoryId = null)
    {
        // dukung dua cara: path param {categoryId} atau query ?category_id=
        $categoryId = $categoryId ?? $request->query('category_id');

        $products = Product::with(['category', 'otcs'])
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->orderBy('nama_product')
            ->get();

        return response()->json($products);
    }
}
