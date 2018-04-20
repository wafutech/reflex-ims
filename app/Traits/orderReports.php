<?php
namespace App\Traits;
use DB;
use Carbon\Carbon;
trait orderReports
{
	/* Process various order reports and return values to IMSReportsController*/
 public function ordersToDate()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'Something went wrong while processing your request';
 }

 public function newOrders()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->where('order_statuses.status','=','New')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'No new orders';
 }

 public function completedOrders()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->where('order_statuses.status','=','Completed')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'No completed orders';
 }

 public function cancelledOrders()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->where('order_statuses.status','=','Cancelled')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'No cancelled orders';
 }

 public function shippedOrders()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->where('order_statuses.status','=','Shipped')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'No shipped orders';
 }

 public function invoicedOrders()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->where('order_statuses.status','=','Invoiced')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'No invoiced orders';
 }


 public function ordersByEmployee()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->groupBy('users.name')
 				->orderBy('users.name','asc')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'Something went wrong';
 }

 		public function ordersByCustomer()
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->groupBy('customers.id')
 				->orderBy('customers.first_name','asc')
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'Something went wrong';
 }

 public function orderMonthlyReport($year=null)
 {
 	if($year==null)
 	{
 		$year = date('Y');
 	}
 	$orders = DB::table('orders')
      ->select(DB::raw('sum(amount) as orderAmount'),DB::raw(' MONTH(order_date) month'))
      ->whereYear('order_date',$year)
      ->groupBy('month')->get();  
       return response()->json($orders);

 }

 public function orderReportComparisonByYear()
    {
    	$data = DB::table('orders')
      ->select(DB::raw('sum(amount) as orderAmount'),DB::raw('YEAR(order_date) year'))
      ->groupBy('year')->get();


      return json_decode($data);
    }

public function orderPeriodicReport($start_date,$end_date)
 {
 	$orders = DB::table('orders')
 				->leftjoin('customers','orders.customer_id','customers.id','orders.customer_id')
 				->leftjoin('payment_methods','orders.payment_method_id','payment_methods.id','orders.payment_method_id')
 				->leftjoin('users','orders.user_id','users.id','orders.user_id')
 				->leftjoin('order_status','orders.order_status_id','order_statuses.id','orders.order_status_id')
 				->whereBetween('orders.order_date',[$start_date,$end_date])
 				->get();
 				if($orders)
 				{
 					return response()->json($orders);
 				}

 				return 'Something went wrong';
 }


	
}