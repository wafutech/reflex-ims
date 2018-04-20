<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Stock;
use App\Product;
use Auth;
use DB;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;


class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use serialGenerator;
    
    public function index()
    {
        $purchases = DB::table('purchases')
                    ->leftjoin('products','purchases.product_id','products.id','purchases.product_id')
                    ->leftjoin('suppliers','purchases.supplier_id','suppliers.id','purchases.supplier_id')
                    ->leftjoin('unit_measures','purchases.unit_measure_id','unit_measures.id','purchases.unit_measure_id')
                    ->leftjoin('users','purchases.user_id','users.id','purchases.user_id')
                    ->get();
        return response()->json($purchases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $purchase = new Purchase;
       $purchase->product_id = $request->input('product_id');
       $purchase->supplier_id = $request->input('supplier_id');
       $purchase->quantity = $request->input('quantity');
       $purchase->unit_cost = $request->input('unit_cost');
       $purchase->amount = $request->input('quantity')*$request->input('unit_cost');
       $purchase->user_id = 1;
       $purchase->save();
       $product = $purchase->product_id;
       $stock = Stock::where('product_id',$product)->first();
       if($stock==null)
       {
        //Get the pruduct
         $theProduct = Product::where('id',$purchase->product_id)->first();
        $stock = new Stock;
        $stock->product_id = $purchase->product_id;
        $stock->warehouse_id = $request->input('warehouse_id');
        $stock->quantity_in_hand =$theProduct->quantity_in_stock+$purchase->quantity;
        $stock->save();

    
           }
       $stock_bal = $stock->quantity_in_hand +$purchase->quantity;
       //update new stock levels;
        DB::update('update stocks set quantity_in_hand=? where product_id =?',[$stock_bal,$product]);

         $transactionCode = $this->transactionCode();
        $transaction = 'Purchased new item with id: '.$purchase->product_id.'purchase order#'.$purchase->id;
        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        return response()->json('Product Purchased');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = Request::all();
        $purchase = findOrFail($id);
        $purchase->fill($input)->save();
        $transactionCode = $this->transactionCode();
        $transaction = 'Updated Purchase Order record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLog($transactionCode,$transaction,$url));
        return response()-json($purchase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $purchase = findOrFail($id);
    $purchase->delete();
    $transactionCode = $this->transactionCode();
        $transaction = 'Updated supplier record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLog($transactionCode,$transaction,$url));
         return response()->json('Purchase Order Removed!');

    }
}
