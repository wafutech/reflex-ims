<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = ['stock_levels'];
    protected $fillable =['product_id','quantity_in_hand'];

    public function product()
    {
    	return $this->belongsTo('App\Product','id');
    }

    public function warehouse()
    {
    	return $this->belongsTo('App\Warehouse','id');
    }
}
