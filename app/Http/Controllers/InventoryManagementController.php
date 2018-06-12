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
use Session;
use Illuminate\Support\Facades\Input;
use Validator;

class InventoryManagementController extends Controller
{
    public function unReceivedStockInventory()
    {
    	$purchases = DB::table('purchases')
                    ->leftjoin('products','purchases.product_id','products.id','purchases.product_id')
                    ->leftjoin('suppliers','purchases.supplier_id','suppliers.id','purchases.supplier_id')
                   // ->leftjoin('unit_measures','purchases.unit_measure_id','unit_measures.id','purchases.unit_measure_id')
                    ->leftjoin('users','purchases.user_id','users.id','purchases.user_id')
                    ->where('purchases.received',0)
                    ->get();
                 return $purchases;

    }


}
