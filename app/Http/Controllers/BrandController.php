<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view("brands.brand_list",compact('brands'));
    }

    public function create(){
        return view("brands.brand_create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'brand_name' => 'required',
        ]);

        if($validator->passes()){
            Brand::create([
                'name' => $request->brand_name,
            ]);
            return redirect()->route('brand.index')->with('success','Brand Created successfully');
        }else{
            return redirect()->route('brand.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $brand = Brand::find($id);
        return view('brands.brand_edit',compact('brand'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'brand_name' => 'required'
        ]);

        if($validator->passes()){
            $brand = Brand::find($request->id);
            $brand->update([
                'name' => $request->brand_name
            ]);

            return redirect()->route('brand.index')->with('success','Brand Updated successfully');
        }else{
            return redirect()->route('brand.edit')->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request){
        $brand = Brand::findOrFail($request->id);

        if($brand == null){
            session()->flash('error','Brand Not Found');
            return response()->json([
                'status' => false,
            ]);
        }

        $brand->delete();
        session()->flash('success','Brand deleted Successfully');

        return response()->json([
            'status'=> true
        ]);
    }
}
