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
use App\Product;
use Illuminate\Support\Facades\Input;
use App\Invoice;
use Validator;
use Session;

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
        $orders = Order::all();
        return $orders;
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

          'customer_id'           => 'required',

          'order_status_id'           => 'required|numeric',
          'order_amount'           => 'required|numeric',
          'paid'           => '',
          'expected_date'           => 'required|date',
           'date_paid'           => 'date',
           'delivery_fee'           => 'required|numeric',
           'notes'           => '',
          
      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return $validator->messages();
    }   
        $order = new Order;
        $order->customer_id = $request->input('customer_id');
         $order->amount = $request->input('order_amount');
        $order->order_date = $request->input('order_date');
        $order->expected_date = $request->input('expected_date');
        $order->delivery_fee = $request->input('delivery_fee');
        
        $order->payment_method_id = $request->input('payment_method_id');
        $order->paid = $request->input('paid');
       $order->date_paid = $request->input('date_paid');
        $order->notes = $request->input('notes');
        $order->order_status_id = $request->input('order_status_id');
        $order->user_id = 1;
        $order->save();
      return $order->id;

}

/*DB::table('order_items')->insert($products);
           

        $transactionCode = $this->transactionCode();
        $transaction = 'Completed order with id: '.$order->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        return response()->json('Order Placed');
         
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $product = Product::findOrFail($id);
        return $product;
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
