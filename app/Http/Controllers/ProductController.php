<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Get all products
     */
    public function index(Request $request){
        return ProductResource::collection(Product::all());
    }

    /**
     * Creates a new product
     */
    public function saveProduct(Request $request){
        $data = $request->validate([
            'name' => 'required|max:45',
            'description' => 'nullable|string|max:45',
            'quantity' => 'nullable|numeric',
        ]);


        $product = new Product();
        $product->name = $data['name'];
        if(isset($data['description'])){
            $product->description = $data['description'];
        }
        if(isset($data['quantity'])){
            $product->quantity = $data['quantity'];
        }
        $product->save();

        return response()->json(['success' => 'Product Item Created.']);
    }
}
