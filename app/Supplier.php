<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table ='suppliers';
    protected $fillable = array('supplier_name','contact_title','mobile_number',
    	'work_phone','phone_code','fax','email','postal_address',
    	'town','zip','phisical_address','country','contact_name');

    public function assets()
    {
    	return $this->hasMany('App\AssetRegister');
    }

     public function inventories()
    {
    	return $this->hasMany('App\Inventory');
    }
}
