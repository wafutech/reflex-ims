<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetRegister;
use App\DepreciationMethod;

class AssetDepreciationCalculationController extends Controller
{
    //
    

    public function straightLineDepreciation($purchasePrice,$salvageValue,$lifeSpan)
    {
    	$depreciableCost = $purchasePrice-$salvageValue;
    	$yearlyDepreciation = number_format($depreciableCost/$lifeSpan,2);
    	return $yearlyDepreciation;

    }

    public function decliningBalDepreciation($purchasePrice,$lifeSpan)
    {
    	$rate = (100/$lifeSpan);
    	$doubleDepreciationRate = $rate*2;    	
      for($i=$lifeSpan+1;$i>1;$i-=1)
      {
       
         $bookValue[] = $purchasePrice-=($doubleDepreciationRate/100)*$purchasePrice;   
         $lifeDepreciation[] = ($doubleDepreciationRate/100)*$purchasePrice;   
        
        
      }
        
    	return $lifeDepreciation;

    }

    public function sumOfYearsDepreciation($purchasePrice,$salvageValue,$usefulYears)
    {
        $usefulYearsReducing = $usefulYears;
        for($i= $usefulYearsReducing;$i>1;$i-=1)
        {
            $sumYears[] = $usefulYearsReducing-=1;

        }

        $denominator = array_sum($sumYears)+$usefulYears;
       
        //Compute depreciation
        
        $usefulYears+=1;
        for($j=$usefulYears;$j>1;$j-=1)
        {
            $lifeDepreciation[] = number_format((($usefulYears-=1)/$denominator)*$salvageValue,2);
        
        }

        return $lifeDepreciation;
       

    }

    public function unitsOfProduction($purchasePrice,$salvageValue,$units,$currentUnits)
    {
        $depreciableCost = $purchasePrice-$salvageValue;
        $depreciationRate = number_format($depreciableCost/$units,2);
        $currentDepreciationCost = number_format($depreciationRate*$currentUnits,2);
       

        return $currentDepreciationCost;



    }

    public function depreciationCal(Request $request)
    {
       
        $dprMethod = $request->input('depreciation_method_id');
        return $request->input('depreciation_method_id');
        
       // $dprMethod = DepreciationMethod::where('id',$dprMethod)->first();
        switch ($dprMethod) {
            case 'Straight Line':
            $price = $request->input('purchase_price');
            $sv = $request->input('salvage_value');
            $lifeSpan = $request->input('useful_years');
                return $this->straightLineDepreciation($price,$sv,$lifeSpan);
                break;
            case 'Declining Balance':
            $price = $request->input('purchase_price');
            $lifeSpan = $request->input('useful_years');
            
            return $this->decliningBalDepreciation($price,$lifeSpan);
            break;
            case 'Sum-of-the-years-digits':
            $price = $request->input('purchase_price');
            $sv = $request->input('salvage_value');
            $lifeSpan = $request->input('useful_years');
            return $this->sumOfYearsDepreciation($price,$sv,$lifeSpan);
            break;

             case 'Unit of Production':
             $price = $request->input('purchase_price');
            $sv = $request->input('salvage_value');
            $lifeSpan = $request->input('useful_years');
            $outerShellUnits = $request->input('life_time_units');
            $currentUnits = $request->input('current_units');
            return $this->unitsOfProduction($price,$sv,$outerShellUnits,$currentUnits);
            break;
            default:
               return 'Select Depreciation Method';
                break;
        }
    }


}
