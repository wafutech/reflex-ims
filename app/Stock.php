<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable =['product_id','warehouse_id','quantity_in_hand'];

    public function product()
    {
    	return $this->belongsTo('App\Product','id');
    }

    public function warehouse()
    {
    	return $this->belongsTo('App\Warehouse','id');
    }
}
