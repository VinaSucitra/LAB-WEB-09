<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::all();
        $selectedWarehouse = $request->input('warehouse_id');

        if ($selectedWarehouse) {
            $warehouse = Warehouse::with('products.detail', 'products.category')->find($selectedWarehouse);
            $products = $warehouse ? $warehouse->products : collect();
        } else {
            $products = Product::with(['category', 'detail', 'warehouses'])->get();
        }

        return view('stocks.index', compact('warehouses', 'selectedWarehouse', 'products'));
    }

    public function transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'quantity_change' => 'required|integer|not_in:0',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($request->product_id);
        $warehouse = Warehouse::findOrFail($request->warehouse_id);
        $change = $request->quantity_change;

        $currentStock = $product->warehouses()->where('warehouse_id', $warehouse->id)->first()?->pivot->quantity ?? 0;
        $newStock = $currentStock + $change;

        if ($newStock < 0) {
            $validator->errors()->add('quantity_change', "Stok yang tersedia ($currentStock) tidak mencukupi untuk pengurangan ini.");
            
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
        
        DB::transaction(function () use ($product, $warehouse, $newStock) {
            $product->warehouses()->syncWithoutDetaching([
                $warehouse->id => ['quantity' => $newStock]
            ]);
        });

        return redirect()->route('stocks.index')->with('success', 'Transfer stok berhasil dilakukan.');
    }
}