<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $fillable = array('order_id','product_id','quantity',
    	'units','unit_cost','amount','order_status_id');
      public function  Order()
    {
    	return $this->belongsTo('App\Order','id');
    }
    public function  Product()
    {
    	return $this->belongsTo('App\Product','id');
    }

    public function  Orderstatus()
    {
    	return $this->belongsTo('App\Orderstatus','id');
    }
    
}
