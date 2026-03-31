<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List products
    public function index()
    {
        $products = Product::all();
        return view('admin.product', compact('products'));
    }

    // Store product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            $img = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/products'), $img);
            $product->image = $img;
        }

        $product->save();
        return redirect()->back()->with('success', 'Product added successfully');
    }

    // Edit page
   public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('admin.product_edit', compact('product'));
}
    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            $img = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/products'), $img);
            $product->image = $img;
        }

        $product->save();
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    // Delete
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product deleted');
    }

    // Status toggle
    public function changeStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();

        return redirect()->back()->with('success', 'Status updated');
    }
    
   public function allshow(){
        return product::all();
   }
   public function add(Request $request){
    
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;

        // if ($request->hasFile('image')) {
        //     $img = time().'.'.$request->image->extension();
        //     $request->image->move(public_path('upload/products'), $img);
        //     $product->image = $img;
        // }

        $product->save();

        return response()->json(['msg'=>'Inserted product successfully']);
   }
}
