<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table ='customers';
    protected $fillable = array('first_name','last_name','mobile_name',
    	'work_phone','phone_code','fax','email','postal_address',
    	'town','zip','phisical_address','company');
}
