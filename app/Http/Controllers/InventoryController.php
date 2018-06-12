<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Inventory;
use App\Product;
use App\Stock;
use Auth;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Illuminate\Support\Facades\Input;
use DB;

class InventoryController extends Controller
{
       use serialGenerator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Inventory::all();
        return $items;
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
        $validation_rules = array(

          'supplier_id'           => 'required',
            'product_id'           => 'required',

          'quantity'           => 'required|numeric',
          'unit_cost'           => 'required',
          'selling_price'           => 'required',
          'purchase_date'           => 'required|date',
          'warehouse_id'           => 'required',
          'vat'           => 'required',
                   

      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return $validator->messages();
    }

        $item = new Inventory;
        $item->supplier_id = $request->supplier_id;
        $item->product_id = $request->product_id;
        $item->quantity = $request->quantity;
        $item->unit_cost = $request->unit_cost;
        $item->selling_price = $request->selling_price;
        $item->sku =$this->productCode(); 
        $item->vat = $request->vat;
        $item->purchase_date = $request->purchase_date;
        $item->expiry_date = $request->expiry_date;
        $item->on_stock = 1;
        $item->barcode = $request->barcode;
        $item->warehouse_id = $request->warehouse_id;
        $item->save();
//Update the purchases model change received status to true
DB::update('update purchases set received=? where product_id =?',[1,$item->product_id]);

         //update new stock levels;
    $stock = Stock::where('product_id',$item->product_id)->first();
    if($stock)
    {
     $stock_bal = $stock->quantity_in_hand+$item->quantity;
      DB::update('update stock_levels set quantity_in_hand=? where product_id =?',[$stock_bal,$item->product_id]);
  
    }
    //create new stock       

        $product = Product::find($item->product_id);
         $stock = new Stock;
        $stock->product_id = $product->id;
        $stock->quantity_in_hand = $product->quantity_in_stock;
        $stock->warehouse_id = $request->warehouse_id;
        $stock->save();

        $transactionCode = $this->transactionCode();
        $transaction = 'Received Inventory Item: '.$product->product_name.' with id: '.$product->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Inventory::findOrFail($id);
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Inventory::findOrFail($id);
        return $item;
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
        $input = $request->all();
        $item = Inventory::findOrFail($id);
        $item->update($input);
        return $item;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);
         $item->delete();
         return 'Inventory Item Removed';
    }
}
