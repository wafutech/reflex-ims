<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table ='suppliers';
    protected $fillable = array('first_name','last_name','mobile_number',
    	'work_phone','phone_code','fax','email','postal_address',
    	'town','zip','phisical_address','company');

    public function assets()
    {
    	return $this->hasMany('App\AssetRegister');
    }
}
