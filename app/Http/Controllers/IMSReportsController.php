<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Supplier;
use App\Customer;
use App\Purchase;
use App\Asset;
use App\AssetCategory;
use Auth;
use Carbon\Carbon;
use App\Traits\orderReports;
use App\Traits\otherReports;
use App\Traits\purchasesReports;
use App\Traits\salesReports;
use App\User;



class IMSReportsController extends Controller
{
	use salesReports;
	use purchasesReports;
	use orderReports;
	use purchasesReports;
	use otherReports;

	public function index($report)
	{
		switch ($report) {
			case 'transactions':
				return $this->transactionLog();
				break;
				case 'stocklevels':
				return $this->stockLevels();
				break;

			
			default:
			return 'No parameter indicated';
				break;
		}
	}

	public function inventoryLevels()
	{

	}

	public function stockLevels()
	{

	}

	public function rawMaterialLevels()
	{

	}

	public function workInProgress()
	{

	}

	public function transactionLog()
	{

	}

	public function salesReport()
	{

	}

	public function purchaseOrders()
	{

	}

	public function customerOrders()
	{

	}

	public function productSales()
	{

	}

	/**
	LISTS
	*/
	public function productList()
	{
		$products = Product::all();
		return $products;
	}

	public function customerList()
	{
		$customers = Customer::all();
		return $customers;
	}

	public function supplierList()
	{
		$suppliers = Supplier::all();
		return $suppliers;
	}

	public function employeeList()
	{
		$employees = User::all();
		return $employees;
	}


    
}
