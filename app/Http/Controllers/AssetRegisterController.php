<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetRegister;
use App\DepreciationMethod;
use App\AssetCondition;
use App\Traits\depreciationCalculator;
use App\Traits\serialGenerator;
use DB;
use Validator;
use Event;
use  App\Events\TransactionLogEvent;
use Illuminate\Support\Facades\Input;

class AssetRegisterController extends Controller
{
    
    use depreciationCalculator;
    use serialGenerator;
    
    var $assetConditions;
    var $depreciationMethods;
    public function __construct()
    {
    	$this->assetConditions = AssetCondition::pluck('condition','id');
    	$this->depreciationMethods = DepreciationMethod::pluck('depreciation_method','id');
    }
    /*List assets--*/

    public function index($id=null)
    {
           
      
    	if($id!=null)
    	{
$assets = DB::table('asset_register')
                ->join('suppliers','asset_register.supplier_id','suppliers.id','asset_register.id')
                ->join('asset_categories','asset_register.category_id','asset_categories.id','asset_register.category_id')
                ->join('asset_conditions','asset_register.asset_condition_id','asset_conditions.id','asset_register.asset_condition_id')
                ->join('depreciation_methods','asset_register.depreciation_method_id','depreciation_methods.id','asset_register.depreciation_method_id')
                ->where('asset_register.id',$id)
                ->get();  

              return $assets;  	
              }

    	$assets = DB::table('asset_register')
                ->join('suppliers','asset_register.supplier_id','suppliers.id','asset_register.id')
                ->join('asset_categories','asset_register.category_id','asset_categories.id','asset_register.category_id')
                ->join('asset_conditions','asset_register.asset_condintion_id','asset_conditions.id','asset_register.asset_condintion_id')
                ->join('depreciation_methods','asset_register.depreciation_method_id','depreciation_methods.id','asset_register.depreciation_method_id')
                ->get();

    	return response()->json($assets);

   // return view('inventory.assets.register',array('title'=>'Asset Register','assets'=>$assets));


    }

    public function create()
    {
    	//return view('assets.create',['title'=>"Add new Asset",'conditions'=>$this->assetConditions,'depreciationMethods'=>$this->depreciationMethdos]);
      return view('accounting.create');
    }

    public function store(Request $request)
		    {
		    $validation_rules = array(

          'asset_description'           => 'required|string',
            'category_id'           => 'required',

          'supplier_id'           => 'required',
          'phisical_location'           => 'required|string',
          'depreciation_method_id'           => 'required|numeric',
          'useful_years'           => 'required',
          'salvage_value'           => 'required|numeric',
          'asset_condintion_id'           => 'required',
         

      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return $validator->messages();
    }
    //Generate asset number

    if($request->input('asset_no')=='')
    {
    $asset_no =  $this->generateAssetNumber($request->input('category_id'));
           // $asset_no =  $this->generateAssetNumber(1);

    }
    $asset_no =$request->input('asset_no');
    
        $asset = new AssetRegister();
        $asset->asset_description = $request->input('asset_description');
        $asset->category_id = $request->input('category_id');
        $asset->acquisition_cost=$request->input('acquisition_cost');
        $asset->supplier_id = $request->input('supplier_id');
        $asset->phisical_location = $request->input('phisical_location');
        $asset->asset_no =  $asset_no;
        $asset->serial_no = $request->input('serial_no');
        $asset->depreciation_method_id = $request->input('depreciation_method_id');
        $asset->useful_years = $request->input('useful_years');
        $asset->salvage_value = $request->input('salvage_value');
       $asset->previous_depreciation = $request->input('previous_depreciation');
      
       $asset->depreciation_in_this_period = $request->input('depreciation_in_this_period');
       $asset->asset_condintion_id = $request->input('asset_condintion_id');
       $asset->closing_bal = $request->input('acquisition_cost'); 
       $asset->acquisition_date = $request->input('acquisition_date');     
       $asset->save();

       $transactionCode = $this->transactionCode();
        $transaction = 'Added fixed asset  with id: '.$asset->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));

       return response()->json('success');

      }

      public function show($id)
      {
      	$asset = AssetRegister::findOrFail($id);
      	return response()->json($asset);
      }

         public function edit($id)
      {
      	$asset = AssetRegister::findOrFail($id);
      	return response()->json($asset);
      }

         public function update(Request $request, $id)
      {
      	$input = $request->all();
      	$asset = AssetRegister::findOrFail($id);
      	$asset->update($input);
        $transactionCode = $this->transactionCode();
        $transaction = 'Updated fixed asset record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
      	return response()->json($asset);
      }

         public function destroy($id)
      {
      	$asset = AssetRegister::findOrFail($id);
      	$asset->delete();
        $transactionCode = $this->transactionCode();
        $transaction = 'Deleted fixed asset record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
      	return response()->json('success');
      }



		    

}
