<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Session;

class PurchaseController extends Controller
{
    public function index(){
        $orders = Purchase::all();
        $suppliers = Supplier::all();
        return view("purchase.purchase_list",compact('orders','suppliers'));
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


    /* --------------Supplier List for Filtering------------- */
    public function search(Request $request){
        $suppliers = Supplier::all();
        $request->validate([
            'supplier_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Session([
            'supplier_id' => $request->supplier_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $supplier_id = session('supplier_id');
        $start_date = session('start_date');
        $end_date = session('end_date');

        if($start_date && $end_date && $supplier_id){
            $orders = Purchase::whereDate('created_at','>=', $start_date)
                                ->whereDate('created_at','<=',$end_date)
                                ->where('supplier_id',$supplier_id)
                                ->get();
            session()->forget(['supplier_id','start_date','end_date']);
            return view('purchase.purchase_list',compact('orders','suppliers'));
        }


    }



}
