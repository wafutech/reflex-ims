<?php 
namespace App\Traits;
trait depreciationCalculator
{
     /*
     This method spreads the cost of the fixed asset evenly over its useful life.
     */
     public function straightLineDepreciation($purchasePrice,$salvageValue,$lifeSpan)
    {
    	$depreciableCost = $purchasePrice-$salvageValue;
    	$yearlyDepreciation = number_format($depreciableCost/$lifeSpan,2);
    	return $yearlyDepreciation;
    }
    /*
    An accelerated method of depreciation, it results in higher depreciation expense in the earlier years of ownership.
    */

    public function decliningBalDepreciation($purchasePrice,$lifeSpan)
    {
    	$rate = (100/$lifeSpan);
    	$doubleDepreciationRate = $rate*2;    	
    	$depreciationValue = 0;
    	$currentValue = $purchasePrice-$deoreciationValue;

    	while($i<$lifeSpan)
    	{
    		$depreciationValue = ($doubleDepreciationRate/100)*($purchasePrice-$depreciationValue);

			$i++;
    	}
    	return $depreciationValue;

    }

    /*
    Compute depreciation expense by adding all years of the fixed asset’s expected useful life and factoring in which year you are currently in, as compared to the total number of years.
    */
    public function someOfTheYearsDigits($purchasePrice,$lifeSpan)
    {
    	$year = '';
    	$denominator = [];
    	for($i=0;$i<$lifeSpan;$i++)
    	{
    		$year.$i = $lifeSpan-1;
    		$denominator = array_push($denominator, $year.$i);
    	}

    	dd($denominator);
    	exit;
    	$denominator = array_sum($denominator);
    	//HELP
    	/*With this method, you come up with a depreciation fraction using the number of years of useful life. Penway’s machine has a useful life of five years. Add (5 + 4 + 3 + 2 + 1 = 15) to get your denominator for the rate fraction. In year 1, your multiplier is 5/15 (1/3); in year 2, the multiplier is 4/15; and so on.

		Again, you subtract the estimated salvage value from the cost ($30,000 – $3,000 = $27,000). The first year, the depreciation expense is $9,000 ($27,000 / 3). In the second year, the depreciation expense is $7,200 ([$27,000 x 4] / 15). For year 3, the depreciation expense is $5,400 ([$27,000 x 3] / 15).

		Year 4 is $3,600 ([$27,000 x 2] / 15). Year 5 is $1,800 ($27,000 / 15).*/
    }

    /*
    The total estimated number of units the fixed asset will produce over its expected useful life, as compared to the number of units produced in the current accounting period, is used to calculate depreciation expense.
    */
    public function unitsOfProduction($purchasePrice,$salvageValue,$unitsOfProduction)
    {
    	$depreciableBase = $purchasePrice-$salvageValue;
    	$depreciationRate = $depreciableBase/$unitsOfProduction;
    	$annualDepreciation = $unitsOfProduction*$depreciationRate;


    }
}