<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $fillable = array('first_name','last_name','mobile_number',
    	'work_phone','phone_code','fax','email','postal_address',
    	'town','zip','phisical_address','company');
}
