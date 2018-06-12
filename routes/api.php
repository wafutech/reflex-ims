<?php

use Illuminate\Http\Request;
use App\OrderStatus;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*----------------------\
| API AUTHENTICATION WITH PASSPORT
------------------------*/
/*Route::Post('login',['as'=>'login','uses'=>'PassportController@login']);
Route::Post('register','PassportController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'auth:api'],function()
{
	Route::post('get-details','PassportController@getDetails');

});*/

/*##########################
# API AUTHENTICATION
#############################*/
Route::group(['middleware'=>'cors'],function()
{
Route::post('auth/register', 'APIAuthController@register');
Route::post('auth/login', 'APIAuthController@login');
Route::group(['middleware' => 'jwt.auth'], function(){  
	
Route::get('auth/user', 'APIAuthController@user');

	});


});

Route::resource('users','UsersController');



Route::group(['middleware' => 'jwt.auth'], function(){  
 Route::post('auth/logout', 'JWTAuthenticateController@APIlogout');

});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::patch('auth/refresh', 'JWTAuthenticateController@refresh');
});

Route::resource('assets','AssetRegisterController');

/***************************
* ASSET CATEGORIES
****************************/
Route::resource('asset/categories','AssetCategoriesController');
/*Route::get('asset/categories','AssetCategoriesController@index');
Route::post('asset/categories/store','AssetCategoriesController@store');*/



Route::post('assets/depreciation','AssetDepreciationCalculationController@depreciationCal');
Route::get('assets/depreciation/methods','AssetDepreciationCalculationController@depreciationMethods');

Route::resource('suppliers','SuppliersController');
Route::resource('customers','CustomersController');
Route::get('reports/{report}','IMSReportsController@index');

/*---------------------
# API LISTS
------------------------*/

Route::get('lists/categories','ListsController@listAssetCategories');

Route::get('lists/suppliers','ListsController@listSuppliers');
Route::get('lists/asset-depreciations','ListsController@listDepreciationMethods');
Route::get('lists/asset-classes','ListsController@assetClasses');

Route::get('lists/asset-conditions','ListsController@assetConditions');

Route::get('lists/unit-of-measures','ListsController@unitMeasures');
Route::get('receive/purchases','InventoryManagementController@unReceivedStockInventory');


/**
PAYMENT METHODS
--------------*/
Route::resource('payment-methods','PaymentmethodsController');

/**
INVENTORY ITEMS
--------------*/
Route::resource('items','InventoryController');
Route::resource('raw-materials','RawMaterialController',['except'=>['create']]);
Route::resource('raw-material-inventory','RawMaterialInventoryController',['except'=>['create']]);
//Products
Route::resource('product/categories','ProductCategoriesController');
Route::resource('products','ProductsController',['except'=>['create','edit']]);
Route::resource('orders','OrdersController');
Route::resource('order/details','OrderdetailsController');

Route::resource('purchases','PurchasesController',['except'=>['create','show','edit']]);
Route::resource('stock','StockController',['except'=>['create','edit']]);

Route::resource('ware-houses','WarehouseController',['except'=>['create']]);

/**
MISC ROUTES
--------------*/
Route::post('order/item','MiscController@singleProduct');

Route::post('company/setup','SettingController@setUp');
//Retrieve order status
Route::get('order/status',function()
{
$status = OrderStatus::all();
return $status;
});
Route::post('virtual/purchases','VirtualSessionsController@getPurchaseOrderItems');
Route::post('virtual/orders','VirtualSessionsController@getSalesOrder');





