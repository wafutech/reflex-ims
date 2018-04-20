<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use App\OrderItem;
use App\Order;
use App\Stock;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use serialGenerator;

    public function index()
    {
        
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
        $order = new Order;
        $order->customer_id = $request->input('customer_id');
         $order->amount = $request->input('order_amount');
        $order->order_date = $request->input('order_date');
        $order->ship_date = $request->input('ship_date');
        $order->ship_fee = $request->input('ship_fee');
        $order->ship_name = $request->input('ship_name');
        $order->payment_method_id = $request->input('payment_method_id');
        $order->paid_date = $request->input('paid_date');
        $order->notes = $request->input('notes');
        $order->order_status_id = $request->input('order_status_id');
        $order->user_id = 1;
        $order->save();
        //Process order details
         $product_id = $request->input('product_id');
         $quantity = $request->input('quantity');
         $unit_cost = $request->input('unit_cost');
         $units = $request->input('units');
         $amount = $request->input('amount');
         $status = $request->input('order_status_id');

        $product =array('product_id'=>$product_id,
            'quantity'=>$quantity,'unit_cost'=>$unit_cost,'amount'=>$amount,'units'=>$units,'order_status_id'=>$status);
        
       $products = [];
for($i= 0; $i < count($product); $i++){
             
    $products[] = [
        'order_id' => 1,
        'product_id' => $product['product_id'],
        'units'=>4,
        'quantity' => $product['quantity'],
        'unit_price' => $product['unit_cost'],
        'product_discount_id'=>0,
        'amount' => $product['amount']
    ];

}
foreach ($products as $key => $item)
 {
    //update new stock levels;
    $stock = Stock::where('product_id',$item['product_id'][$key])->first();
    $stock_bal = $stock->quantity_in_hand-$item['quantity'][$key];

        DB::update('update stocks set quantity_in_hand=? where product_id =?',[$stock_bal,$item['product_id'][$key]]);
}

DB::table('order_items')->insert($products);
           

        $transactionCode = $this->transactionCode();
        $transaction = 'Completed order with id: '.$order->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        return response()->json('Order Placed');
         
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
        $input = $request->all();
        $order = Order::findOrFail($id);
        $order->fill($input)->save();
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $order = Order::findOrFail($id);
    return $order->delete();

    }
}
