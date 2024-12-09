<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255', 
        'category' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'description' => 'nullable|string',
        'manufacturer' => 'required|string|max:255',
    ]);

    Product::create($validated);

    return redirect()->route('dashboard')->with('product_success', 'Product has been added successfully');
}

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard')->with('product_deleted', 'Product deleted successfully');
    }

    public function edit(Product $product)
    {
        return view('edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'manufacturer' => 'required|string|max:255',
        ]);
    
        $product->update($validated);

        return redirect()->route('dashboard')->with('product_success', 'Product updated successfully');
    }
    

}
