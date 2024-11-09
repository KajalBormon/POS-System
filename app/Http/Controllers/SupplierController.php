<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Validator;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::all();
        return view("supplier.supplier_list",compact('suppliers'));
    }

    public function create(){
        return view('supplier.supplie_create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'phone' => 'required|max_digits:11|min_digits:11',
            'email' => 'email',
            'status' => 'required'
        ]);

        if($validator->passes()){
            Supplier::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'status' => $request->status
            ]);

            return redirect()->route('supplier.index')->with("success","Supplier Added Successfully");
        }else{
            return redirect()->route('supplier.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $supplier = Supplier::find($id);
        return view('supplier.supplier_edit',compact('supplier'));
    }

    public function update(Request $request, $supplier){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'phone' => 'required|max_digits:11|min_digits:11',
            'email' => 'email',
            'status' => 'required'
        ]);

        if($validator->passes()){
            $supplier = Supplier::find($supplier);
            $supplier->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'status' => $request->status
            ]);
            return redirect()->route('supplier.index')->with("success","Supplier Updated Successfully");
        }else{
            return redirect()->route('supplier.edit')->withErrors($validator)->withInput();
        }
    }

    public function destroy($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        
        return redirect()->route('supplier.index')->with('Supplier Deleted successfully');
    }
}
