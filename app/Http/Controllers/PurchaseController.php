<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class PurchaseController extends Controller
{
    public function index(){
        $orders = Purchase::all();
        return view("purchase.purchase_list",compact('orders'));
    }

    public function create(){
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('purchase.purchase_create',compact('products','suppliers'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
            'supplier_id' => 'required',
            'supplier_id.*' => 'exists:suppliers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('purchase.create')->withErrors($validator)->withInput();
        }

        $productIds = $request->input('product_id');
        $quantities = $request->input('qty');
        $supplierId = $request->input('supplier_id'); // Assumed to be a single value, not an array
        $prices = $request->input('price');
        $orderNo = "ORD-" . strtoupper(uniqid());

        foreach ($productIds as $index => $productId) {
            $quantity = $quantities[$index];
            $price = $prices[$index];
            $subtotal = $price * $quantity; // Calculate subtotal for each item

            Purchase::create([
                'supplier_id' => $supplierId,
                'product_id' => $productId,
                'order_no' => $orderNo,
                'price' => $price,
                'qty' => $quantity,
                'subtotal' => $subtotal, // Use the calculated subtotal here
                'status' => 1,
            ]);
        }

        return redirect()->route('purchase.index')->with('success', 'Orders Created Successfully');
    }

    public function destroy($id){
        $purchase = Purchase::findOrFail($id);
        if($purchase){
            $purchase->delete();
            return redirect()->route('purchase.index')->with('success','Purchase Deleted Successfully');
        }
    }




}
