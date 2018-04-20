<?php

use Illuminate\Database\Seeder;
use App\DepreciationMethod;

class DepreciationMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depreciation = [

        	[

        		'depreciation_method' => 'Straight Line',

        		'description' => 'This method spreads the cost of the fixed asset evenly over its useful life.'

        	],

        	[

        		'depreciation_method' => 'Declining Balance',

        		'description' => 'An accelerated method of depreciation, it results in higher depreciation expense in the earlier years of ownership.'


        	],

        	[

        		'depreciation_method' => 'Sum-of-the-years’ digits',

        		'description' => 'Compute depreciation expense by adding all years of the fixed asset’s expected useful life and factoring in which year you are currently in, as compared to the total number of years.'


        	],

        	[

        		'depreciation_method' => 'Units-of-production',

        		'description' => 'The total estimated number of units the fixed asset will produce over its expected useful life, as compared to the number of units produced in the current accounting period, is used to calculate depreciation expense.'

        	]
        ];

        	 foreach ($depreciation as $key => $value) {

        	DepreciationMethod::create($value);
        }
    }
}
