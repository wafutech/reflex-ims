<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;
use App\Stock;
use Auth;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Illuminate\Support\Facades\Input;
//use Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use serialGenerator;

    public function __construct()
    {
    //$this->middleware(['auth']);
    }
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
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

/*        $validation_rules = array(

            'product_name'   => 'required|string|unique:products',
            'product_description'   => 'required|string',
            'category_id' => 'required',
            'unit_id' =>'required',
            'list_price'=>'required',
            'quantity_in_stock' => 'required|numeric',
            'min_order'=>'required|numeric',
            'reorder_level'=>'requred|numeric',
            'reorder_quantity' =>'required|numeric',
            'supply_capacity'=> 'required|numeric',


      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return $validator->messages();
    }*/
      
$product = new Product;
        $product->product_code = $this->productCode();
        $product->product_name = $request->input('product_name');
        $product->product_description = $request->input('product_description');
        $product->category_id = $request->input('category_id');
      $product->unit_id = $request->input('unit_id');
     $product->unit_cost = $request->input('unit_cost');
      $product->list_price = $request->input('list_price');
       $product->quantity_in_stock = $request->input('quantity_in_stock');
        $product->min_order = $request->input('min_order');
     $product->reorder_level = $request->input('reorder_level');
      $product->reorder_quantity = $request->input('reorder_quantity');
       //$product->supply_capacity = $request->input('supply_capacity');
     $product->barcode = $request->input('barcode');
      $product->quantity_per_unit = $request->input('quantity_per_unit');
       $product->user_id = 1;//Auth::User()->id;
        $product->discontinued = $request->input('discontinued');
        $product->save();
        //update stock bal
        $stock = new Stock;
        $stock->product_id = $product->id;
        $stock->quantity_in_hand = $product->quantity_in_stock;
        $stock->warehouse_id = 1;
        $stock->save();
        $transactionCode = $this->transactionCode();
        $transaction = 'Added new product: '.$product->product_name.' with id: '.$product->id;
        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        return response()->json('Product created!',201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
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
          $product = Product::findOrFail($id);
            $input = $request->all();
         $product->fill($input)->save();
         $transactionCode = $this->transactionCode();
        $transaction = 'Updated product: '.$product->name.' with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLog($transactionCode,$transaction,$url));
         return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $product = Product::findOrFail($id);
   
         $transactionCode = $this->transactionCode();
        $transaction = 'Deleted product: '.$product->product_name.' with id: '.$id;
        
        $url = $request->fullUrl();
        Event::Fire(new TransactionLog($transactionCode,$transaction,$url));
    return $product->delete();

    }
}
