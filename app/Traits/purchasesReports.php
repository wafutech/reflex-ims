<?php
namespace App\Traits;
use DB;
use Carbon\Carbon;
trait purchasesReports
{
	/* Process various purchase order reports and return values to IMSReportsController*/
	 
 public function purchaseOrdersToDate()
 {
 	$purchases = DB::table('purchases')
 				->leftjoin('products','purchases.product_id','products.id','purchases.product_id')
 				->leftjoin('suppliers','purchases.supplier_id','suppliers.id','purchases.supplier_id')
 				->leftjoin('users','purchases.user_id','users.id','purchases.user_id')
 				->leftjoin('unit_measures','purchases.unit_measure_id','unit_measures.id','purchases.unit_measure_id')
 				->get();
 				if($purchases)
 				{
 					return response()->json($purchases);
 				}

 				return 'Something went wrong while processing your request';
 }

 
 public function purchaseOrdersByEmployee()
 {
 	$purchases = DB::table('purchases')
 				->leftjoin('products','purchases.product_id','products.id','purchases.product_id')
 				->leftjoin('suppliers','purchases.supplier_id','suppliers.id','purchases.supplier_id')
 				->leftjoin('users','purchases.user_id','users.id','purchases.user_id')
 				->leftjoin('unit_measures','purchases.unit_measure_id','unit_measures.id','purchases.unit_measure_id')
 				->groupBy('users.name')
 				->orderBy('users.name','asc')
 				->get();
 			
 				if($purchases)
 				{
 					return response()->json($purchases);
 				}

 				return 'Something went wrong while processing your request';


 	
 }

 		public function PurchaseOrdersByVendor()
 {
 	$purchases = DB::table('purchases')
 				->leftjoin('products','purchases.product_id','products.id','purchases.product_id')
 				->leftjoin('suppliers','purchases.supplier_id','suppliers.id','purchases.supplier_id')
 				->leftjoin('users','purchases.user_id','users.id','purchases.user_id')
 				->leftjoin('unit_measures','purchases.unit_measure_id','unit_measures.id','purchases.unit_measure_id')
 				->groupBy('suppliers.id')
 				->orderBy('suppliers.first_name','asc')
 				->get();
 				
 				if($purchases)
 				{
 					return response()->json($purchases);
 				}

 				return 'Something went wrong while processing your request';
 }

 public function purchaseOrderMonthlyReport($year=null)
 {
 	if($year==null)
 	{
 		$year = date('Y');
 	}
 	$purchases = DB::table('purchases')
      ->select(DB::raw('sum(amount) as purchaseAmount'),DB::raw(' MONTH(order_date) month'))
      ->whereYear('created_at',$year)
      ->groupBy('month')->get();  
       return response()->json($purchases);

 }

 public function purchaseOrderReportComparisonByYear()
    {
    	$data = DB::table('purchases')
      ->select(DB::raw('sum(amount) as purchaseAmount'),DB::raw('YEAR(created_at) year'))
      ->groupBy('year')->get();


      return json_decode($data);
    }

public function purchaseOrderPeriodicReport($start_date,$end_date)
 {
 	
 	$purchases = DB::table('purchases')
 				->leftjoin('products','purchases.product_id','products.id','purchases.product_id')
 				->leftjoin('suppliers','purchases.supplier_id','suppliers.id','purchases.supplier_id')
 				->leftjoin('users','purchases.user_id','users.id','purchases.user_id')
 				->leftjoin('unit_measures','purchases.unit_measure_id','unit_measures.id','purchases.unit_measure_id')
 				->whereBetween('purchases.created_at',[$start_date,$end_date])
 				->get();
 				if($purchases)
 				{
 					return response()->json($purchases);
 				}

 				return 'Something went wrong while processing your request';
 	
 }


	
}