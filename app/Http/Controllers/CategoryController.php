<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.category_list',compact('categories'));
    }

    public function create(){
        return view('category.category_create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'category_name' => 'required'
        ]);

        if($validator->passes()){
            Category::create([
                'name' => $request->category_name
            ]);
            return redirect()->route('category.index')->with('success','Category Added Successfully');
        }else{
            return redirect()->route('category.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('category.category_edit',compact('category'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'category_name' => 'required'
        ]);

        if($validator->passes()){
            $category = Category::findOrFail($request->id);
            $category->update([
                'name' => $request->category_name
            ]);
            return redirect()->route('category.index')->with('success','Updated Successfully');
        }else{
            return redirect()->route('category.edit')->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request){
        $category = Category::findOrFail($request->id);

        if($category == null){
            session()->flash('error','Category Not Found');
            return response()->json([
                'status' => false
            ]);
        }

        $category->delete();
        session()->flash('success','Category Deleted Successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
