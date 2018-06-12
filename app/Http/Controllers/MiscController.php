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

class MiscController extends Controller
{
    //Fetch a single product
    public function singleProduct(Request $request)
    {
    $product_id = $request->product_id;
    $product = Product::find($product_id);
    return response()->json($product);
    }
    
}
