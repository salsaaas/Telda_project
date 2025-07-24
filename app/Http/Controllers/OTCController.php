<?php
namespace App\Http\Controllers;
use App\Models\OTC;
use Illuminate\Http\Request;
class OTCController extends Controller
{
    public function index()
    {
        $otcs = OTC::with('products')->get();
        return response()->json($otcs);
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_OTC' => 'required|string|max:255',
            'price_OTC' => 'required|numeric|min:0',
        ]);
        $otc = OTC::create($request->only('category_OTC', 'price_OTC'));
        return response()->json([
            'message' => 'OTC created successfully',
            'data' => $otc
        ], 201);
    }
    public function show($id)
    {
        $otc = OTC::with('products')->find($id);
        if (!$otc) {
            return response()->json(['message' => 'OTC not found'], 404);
        }
        return response()->json($otc);
    }
    public function update(Request $request, $id)
    {
        $otc = OTC::find($id);
        if (!$otc) {
            return response()->json(['message' => 'OTC not found'], 404);
        }
        $request->validate([
            'category_OTC' => 'required|string|max:255',
            'price_OTC' => 'required|numeric|min:0',
        ]);
        $otc->update($request->only('category_OTC', 'price_OTC'));
        return response()->json([
            'message' => 'OTC updated successfully',
            'data' => $otc
        ]);
    }
    public function destroy($id)
    {
        $otc = OTC::find($id);
        if (!$otc) {
            return response()->json(['message' => 'OTC not found'], 404);
        }
        $otc->delete();
        return response()->json(['message' => 'OTC deleted successfully']);
    }
    public function getByCategory($category)
    {
        $otcs = OTC::where('category_OTC', $category)->get();
        return response()->json($otcs);
    }
}