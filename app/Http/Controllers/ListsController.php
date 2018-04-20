<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetCategory;
use App\Supplier;
use App\DepreciationMethod;
use App\AssetCondition;
use App\AssetClass;
use App\UnitMeasure;
use DB;

class ListsController extends Controller
{
    var $assetCategories;
    public function __construct()
    {
    	$this->assetCategories = AssetCategory::pluck('description','id');
    }

    public function listAssetCategories()
    {
    	//return $this->assetCategories;
    	$assetCategories = AssetCategory::all();
    	return $assetCategories;
    }

    public function listSuppliers()
    {
    	$suppliers = DB::table('suppliers')->get();
    	return response()->json($suppliers);
    }

    public function listDepreciationMethods()
    {
    	$dpMethods = DepreciationMethod::all();
    	return $dpMethods;
    }

    public function assetConditions()
    {
    	$conditions = AssetCondition::all();
    	return $conditions;
    }

    public function assetClasses()
    {
    	$classes = AssetClass::all();
    	return $classes;
    }

    public function unitMeasures()
    {
        $unitMeasures = UnitMeasure::all();
        return $unitMeasures;
    }
    


}
