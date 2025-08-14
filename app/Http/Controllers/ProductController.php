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
            // kolom DB: unsignedBigInteger -> gunakan integer
            'price'        => 'required|integer|min:0',
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
            'price'        => 'required|integer|min:0',
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
            // SELARASKAN DENGAN MIGRASI OTC: asumsi tabel 'otcs' pk default 'id'
            'otc_id'   => 'required|exists:otcs,id',
            'duration' => 'required|integer|min:1',
            'ppn_rate' => 'nullable|numeric|min:0|max:1',
        ]);

        $breakdown = $product->calculateTotalPrice(
            $request->otc_id,
            (int) $request->duration,
            $request->ppn_rate ?? 0.11
        );

        if ($breakdown === null) {
            return response()->json(['message' => 'Invalid OTC selected'], 400);
        }

        // Product::calculateTotalPrice() mengembalikan array rincian
        return response()->json([
            'product'   => $product->load('category'),
            'otc_id'    => (int) $request->otc_id,
            'duration'  => (int) $request->duration,
            'ppn_rate'  => (float) ($request->ppn_rate ?? 0.11),
            'breakdown' => $breakdown,
            'total'     => $breakdown['total_price'] ?? null,
        ]);
    }

    // =========================
    // Endpoint ramah Select2
    // GET /products/by-category?category_id=1&q=inet
    // ATAU ?category=INDIBIZ
    // =========================
    public function byCategory(Request $request)
    {
        $categoryId = $request->query('category_id');
        $category   = $request->query('category'); // nama kategori (mis. ASTINET)
        $search     = trim((string) $request->query('q', ''));

        // Jika user kirim 'category' (nama), konversi ke category_id
        if (!$categoryId && $category) {
            $categoryId = Category::where('nama_category', $category)->value('category_id');
        }

        // SELECT unik per nama_product (ambil id terendah sebagai wakil)
        $q = Product::query()
            ->when($categoryId, fn($qq) => $qq->where('category_id', $categoryId))
            ->when($search !== '', fn($qq) => $qq->where('nama_product', 'like', "%{$search}%"));

        $items = $q->selectRaw('MIN(id) as id, nama_product')
            ->groupBy('nama_product')
            ->orderBy('nama_product')
            ->limit(100)
            ->get()
            ->map(fn($p) => ['id' => (int) $p->id, 'text' => $p->nama_product]);

        return response()->json($items);
    }

    // =========================
    // Legacy (tetap boleh dipakai)
    // GET /products/category/{categoryId}
    // =========================
    public function getByCategory(Request $request, $categoryId = null)
    {
        $categoryId = $categoryId ?? $request->query('category_id');

        $products = Product::with(['category', 'otcs'])
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->orderBy('nama_product')
            ->get();

        return response()->json($products);
    }
}
