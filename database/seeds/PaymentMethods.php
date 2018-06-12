<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class PaymentMethods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $pms = [

        	[

        		'payment_method' => 'Mpesa'       		

        	],

        	[

        		'payment_method' => 'Airtel Money'       		

        	],

        	[

        		'payment_method' => 'Bank'       		

        	],

        	[

        		'payment_method' => 'Check'       		

        	],

        	[

        		'payment_method' => 'PayPal'       		

        	],

        	[

        		'payment_method' => 'Credit Card'       		

        	],

        	[

        		'payment_method' => 'PesaPal'       		

        	],

        	[

        		'payment_method' => 'Tcash'       		

        	],

        	[

        		'payment_method' => 'cash'       		

        	]

        ];

        foreach ($pms as $key => $value) {

        	PaymentMethod::create($value);
        }
    }
}
