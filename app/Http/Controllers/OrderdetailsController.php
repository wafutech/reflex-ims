<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
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

class OrderdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //Process order details
        $items = [];
        $order_items = $request->all();
        //array_push($items, $order_items);
        return $order_items;
       foreach ($order_items as $key => $item) {
          
            $orderitem = new OrderItem;
            $orderitem->order_id=24;
            $orderitem->product_id =$item->product_id ;
            $orderitem->unit_cost =$item->selling_price;
            $orderitem->quantity =$item->quantity;
            $orderitem->amount =$item->amount;
            $orderitem->save() ;

           }
       
        
        /*for($i=0; $i<count($items);$i++)
        {
            $orderitem = new OrderItem;
            $orderitem->order_id = 24;
            $orderitem->product_id =$items['product_id'][$i] ;
            $orderitem->unit_cost =$items['selling_price'][$i] ;
            $orderitem->quantity =$items['quantity'][$i] ;
            $orderitem->amount =$items['amount'][$i] ;
            $orderitem->save() ;

        }*/
      
       //return 'Success';

         $product_id = $request->input('product_id');
         $quantity = $request->input('quantity');
         $unit_cost = $request->input('selling_price');
         $units = $request->input('units');
         $amount = $request->input('amount');

        $product =array('product_id'=>$product_id,
            'quantity'=>$quantity,
            'unit_cost'=>$unit_cost,'amount'=>$amount,'units'=>$units);
       /* $products = [];
for($i= 0; $i < count($product); $i++){
             
    $products[] = [
        'order_id' => 9,
        'product_id' => $product['product_id'],
        'units'=>4,
        'quantity' => $product['quantity'],
        'unit_cost' => $product['selling_price'],
        //'product_discount_id'=>0,
        'amount' => $product['amount']
    ];

}
foreach ($products as $key => $item)
 {
    //update new stock levels;
    $stock = Stock::where('product_id',$item['product_id'][$key])->first();
    $stock_bal = $stock->quantity_in_hand-$item['quantity'][$key];

        DB::update('update stocks set quantity_in_hand=? where product_id =?',[$stock_bal,$item['product_id'][$key]]);
        //Generate invoice
        $invoice = new Invoice;
        $invoice->order_id = $order->id;
        $invoice->invoice_date = $order->order_date;
        $invoice->save();
    }

    DB::table('order_items')->insert($products);
           

        $transactionCode = $this->transactionCode();
        $transaction = 'Completed order with id: '.$order->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        return response()->json('Order Placed');*/

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
