<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierResource;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use App\Models\Product;

class SupplierController extends Controller
{
    
    /**
     * Get all products
     */
    public function index(Request $request){
        return SupplierResource::collection(Supplier::all());
    }    
    
    /**
    * Get all supply products
    */
    public function supplyProducts(Request $request){
        return SupplierResource::collection(SupplierProduct::all());
    }

    /**
     * Creates a new supplier
     */
    public function saveSupplier(Request $request){

        $data = $request->validate([
            'name' => 'required|max:45',
        ]);


        $supplier = new Supplier();
        $supplier->name = $data['name'];
    
        $supplier->save();

        return response()->json(['success'=>'Supplier Created.']);
    }


    /**
     * Creates a new supplier products entry
     */
    public function saveSupplierProduct(Request $request){

        $validatedData = $request->validateWithBag('purchaseOrder', [
            'supplier_id' => 'required|numeric',
            'items' => 'required|array',
            'items.*.id' => 'required|numeric',
            'items.*.quantity' => 'required|numeric',
        ]);

        $supplier = Supplier::find($validatedData['supplier_id']);

        //Loop through items in order
        foreach($validatedData['items'] as $item){
            $product = Product::find($item['id']);
            if(empty($product)){
                continue; //If product not found, don't save. complete loop
            }
            $supplierProduct = new SupplierProduct();
            $supplierProduct->product()->associate($product);
            $supplierProduct->supplier()->associate($supplier);
            $supplierProduct->save();   
        }


        return response()->json(['success' => 'Order created']);
    }
}
