<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitMeasure extends Model
{
    protected $table ='unit_measures';
    protected $fillable =['unit_code','unit_description'];

    public function products()
    {
    	return $this->hasMany('App\Product');
    }
}
