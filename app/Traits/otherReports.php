<?php
namespace App\Traits;
use DB;
use Carbon\Carbon;
use App\Stock;
trait otherReports
{
	/* Process various order reports and return values to IMSReportsController*/
 public function listofFixedAssets()
 {
  
 	$assets = DB::table('asset_register')
 				->leftjoin('asset_categories','asset_register.category_id','asset_categories.id','asset_register.category_id')
 				->leftjoin('depreciation_methods','asset_register.depreciation_method_id','depreciation_methods.id','asset_register.depreciation_method_id')
 				->leftjoin('asset_conditions','asset_register.asset_condintion_id','asset_conditions.id','asset_register.asset_condintion_id')
 				->leftjoin('suppliers','asset_register.supplier_id','suppliers.id','asset_register.supplier_id')
        ->orderBy('asset_description','asc')
 				->get();
 				if($assets)
 				{
 					return response()->json($assets);
 				}

 				return 'Something went wrong while processing your request';
 }

 public function productList()
 {
 	
  $products = DB::table('products')
              ->join('product_categories','products.category_id','product_categories.id','products.category_id')
              ->join('unit_measures','products.unit_id','unit_measures.id','products.unit_id')
              ->join('users','products.user_id','users.id','products.user_id')
              ->orderBy('product_name','asc')
              ->get();
              return $products;
 }

 public function transactionLog()
 {
  $transactions = DB::table('transaction_logs')
                  ->join('users','transaction_logs.user_id','users.id','transaction_logs.user_id')
                  ->select(DB::raw('transaction_logs.transaction_code'),
                    DB::raw('transaction_logs.transaction_details'),DB::raw('transaction_logs.url'),DB::raw('users.name'),DB::raw('transaction_logs.created_at'))
                  ->orderBy('created_at','desc')
                  ->get();
                  return $transactions;
 }

 public function stockLevels()
 {
 /*	$stock = DB::table('stocks')
 				->join('products','stocks.product_id','products.id','stocks.product_id')
 				->join('warehouses','stocks.warehouse_id','warehouses.id','stocks.warehouse_id')
        ->select(DB::raw('products.product_name'),DB::raw('sum(quantity_in_hand as stock_balance'))
        ->groupBy('products.product_name','quantity_in_hand')
 				->get();*/
        $stock = Stock::all();
 				if($stock)
 				{
 					return response()->json($stock);
 				}

 				return 'OOPs!! Something went wrong';
 }

 


 

 


	
}