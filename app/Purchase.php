<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable =['product_id','supplier_id','quantity','unit_cost','amount','user_id','unit_measure_id'];

    public function product()
    {
    	return $thiss->belongsTo('App\Product','id');
    }

    public function supplier()
    {
    	return $thiss->belongsTo('App\Supplier','id');
    }

    public function user()
    {
    	return $thiss->belongsTo('App\User','id');
    }

     public function unitMeasure()
    {
        return $thiss->belongsTo('App\UnitMeasure','id');
    }
}
