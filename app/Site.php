<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['site_code','site_name'];

    public function warehouses()
    {
    	return $this->hasMany('App\Warehouse','id');
    }
}
