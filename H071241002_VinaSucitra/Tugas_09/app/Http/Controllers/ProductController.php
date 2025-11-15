<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'detail', 'warehouses'])->latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();
        return view('products.create', compact('categories', 'warehouses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0',
            'size' => 'nullable|string',
            'warehouses' => 'required|array',
            'quantities' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
            ]);

            $product->detail()->create([
                'description' => $request->description,
                'weight' => $request->weight,
                'size' => $request->size,
            ]);

            foreach ($request->warehouses as $index => $warehouse_id) {
                $product->warehouses()->attach($warehouse_id, [
                    'quantity' => $request->quantities[$index] ?? 0,
                ]);
            }
        });

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();
        $product->load(['detail', 'warehouses']);
        return view('products.edit', compact('product', 'categories', 'warehouses'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0',
            'size' => 'nullable|string',
            'warehouses' => 'required|array',
            'quantities' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $product) {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
            ]);

            $product->detail()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'description' => $request->description,
                    'weight' => $request->weight,
                    'size' => $request->size,
                ]
            );

            $syncData = [];
            foreach ($request->warehouses as $index => $warehouse_id) {
                $syncData[$warehouse_id] = ['quantity' => $request->quantities[$index] ?? 0];
            }

            $product->warehouses()->sync($syncData);
        });

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->warehouses()->detach();
            $product->detail()->delete();
            $product->delete();
        });

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'detail', 'warehouses'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
