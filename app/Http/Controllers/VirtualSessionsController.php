<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class VirtualSessionsController extends Controller
{
    public function getPurchaseOrderItems(Request $request)
    {
    	
    	$items = $request->all();
    session::put('purchaseOrderItems',$items);
    			
    			return (session::get('purchaseOrderItems'));

    		
    }

    public function getSalesOrder(Request $request)
    {
    	$items = $request->all();
    	  session::put('orderItems',$items);    			
    	return (session::get('orderItems'));
    }
}
