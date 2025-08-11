<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\OTC;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'otcs'])->get();
        return response()->json($products);
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'nama_product' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        $product = Product::create($request->only('category_id', 'nama_product', 'price'));
        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product->load('category')
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
            'category_id' => 'required|exists:categories,category_id',
            'nama_product' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        $product->update($request->only('category_id', 'nama_product', 'price'));
        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product->load('category')
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
            'otc_id' => 'required|exists:otc,id_OTC',
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
            'product' => $product->load('category'),
            'otc_id' => $request->otc_id,
            'duration' => $request->duration,
            'ppn_rate' => $request->ppn_rate ?? 0.11,
            'total_price' => $totalPrice
        ]);
    }
    public function getByCategory(Request $request)
    {
        $categoryId = $request->query('category');
        $products = Product::with(['category', 'otcs'])
            ->where('category_id', $categoryId)
            ->get();
            
        return response()->json($products);
    }
}