<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view("product.products_list",compact('products'));
    }

    public function create(){
        $brands = brand::all();
        $categories = Category::all();
        return view('product.product_create',compact('brands','categories'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'price' => 'required',
            'brand_name' => 'required',
            'category_name' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'brand' => $request->brand_name,
                'category' => $request->category_name,
                'status' => $request->status,
            ]);
            return redirect()->route('product.index')->with('success','Product Added Successfully');
        }else{
            return redirect()->route('product.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $product = Product::find($id);
        return view("product.product_edit",compact('product'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required',
            'brand_name' => 'required',
            'category_name' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            $productUpdate = Product::find($id);
            $productUpdate->update([
                'name' => $request->name,
                'price' => $request->price,
                'brand' => $request->brand_name,
                'category' => $request->category_name,
                'status' => $request->status,
            ]);

            return redirect()->route('product.index')->with('success','Product Updated Successfully');
        }else{
            return redirect()->route('product.edit')->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request){
        $product = Product::findOrFail($request->id);

        if($product ==  null){
            session()->flash('error','Product Not Found');
            return response()->json([
                'status' => false
            ]);
        }

        $product->delete();
        session()->flash('success', 'Product Deleted Successfully');
        return response()->json([
            'status' => true
        ]);
    }

}
