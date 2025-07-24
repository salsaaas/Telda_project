<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_category' => 'required|string|max:255',
        ]);
        $category = Category::create([
            'nama_category' => $request->nama_category,
        ]);
        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }
    public function show($id)
    {
        $category = Category::with('products')->find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $request->validate([
            'nama_category' => 'required|string|max:255',
        ]);
        $category->update([
            'nama_category' => $request->nama_category,
        ]);
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}