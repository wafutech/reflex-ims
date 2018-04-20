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
    
}
