<?php
namespace App\Traits;
use DB;
use Carbon\Carbon;
trait salesReports
{
	/* Process various purchase order reports and return values to IMSReportsController*/
	 
 public function salesToDateByProduct()
 {
 	$sales = DB::table('order_items')
 				->leftjoin('orders','order_items.order_id','order_items.order_id','orders.id')
 				->leftjoin('products','order_items.product_id','order_items.product_id','products.id')
 				
 				->select(DB::raw('sum(amount) as sales'),DB::raw('products.product_name'))
 				->groupBy('products.name','sales')
 				->get();
 				if($sales)
 				{
 					return response()->json($sales);
 				}

 				return 'Something went wrong while processing your request';

 	}


 	public function salesByCustomer()
 {
 	$sales = DB::table('order_items')
 				->leftjoin('orders','order_items.order_id','order_items.order_id','orders.id')
 				->leftjoin('products','order_items.product_id','order_items.product_id','products.id')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id') 				
 				->select(DB::raw('sum(order_items.amount) as sales'),DB::raw('customers.first_name'),DB::raw('customers.last_name'),DB::raw('customers.company'))
 				->groupBy('customers.first_name','customers.last_name','customers.company','sales')
 				->get();
 				if($sales)
 				{
 					return response()->json($sales);
 				}

 				return 'Something went wrong while processing your request';

 	}

 	public function salesByEMployee()
 {
 	$sales = DB::table('order_items')
 				->leftjoin('orders','order_items.order_id','order_items.order_id','orders.id')
 				->leftjoin('products','order_items.product_id','order_items.product_id','products.id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id') 				
 				->select(DB::raw('sum(order_items.amount) as sales'),DB::raw('users.name'))
 				->groupBy('users.name','order_items.amount')
 				->get();
 				if($sales)
 				{
 					return response()->json($sales);
 				}

 				return 'Something went wrong while processing your request';

 	}

 
 public function salesByProductCategory()
 {
 	
 	$sales = DB::table('order_items')
 				->leftjoin('orders','order_items.order_id','order_items.order_id','orders.id')
 				->leftjoin('products','order_items.product_id','order_items.product_id','products.id')
 				->leftjoin('product_categories','products.category_id','product_categories.id','products.category_id') 				
 				->select(DB::raw('sum(order_items.amount) as sales'),DB::raw('product_categories.category_name'))
 				->groupBy('category_name','sales')
 				->get();
 				if($sales)
 				{
 					return response()->json($sales);
 				}

 				return 'Something went wrong while processing your request';

 	
 }

 		

 public function salesMonthlyReport($year=null)
 {
 	if($year==null)
 	{
 		$year = date('Y');
 	}
 	$sales = DB::table('orders')
      ->select(DB::raw('sum(amount) as sales'),DB::raw(' MONTH(order_date) month'))
      ->whereYear('created_at',$year)
      ->groupBy('month')->get();  
       return response()->json($sales);

 }

 public function salesReportComparisonByYear()
    {
    	$sales = DB::table('orders')
      ->select(DB::raw('sum(amount) as sales'),DB::raw('YEAR(order_date) year'))
      ->groupBy('year')->get();


      return json_decode($sales);
    }

public function salesPeriodicReport($start_date,$end_date)
 {
 	$sales = DB::table('order_items')
 				->leftjoin('orders','order_items.order_id','order_items.order_id','orders.id')
 				->leftjoin('products','order_items.product_id','order_items.product_id','products.id')
 				
 				->select(DB::raw('sum(amount) as sales'),DB::raw('products.product_name'))
 				->groupBy('products.name','sales')
 				->whereBetween('order_items.created_at',[$start_date,$end_date])
 				->get();
 				if($sales)
 				{
 					return response()->json($sales);
 				}

 				return 'Something went wrong while processing your request';
 	

 		
 }


	
}