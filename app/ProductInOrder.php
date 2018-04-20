<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInOrder extends Model
{
    protected $fillable = ['order_item_id','order_id','product_id','quantity'];

    public function orderitem()
    {
    	return $thiss->belongsTo('App\Orderitem','id');
    }

    public function order()
    {
    	return $thiss->belongsTo('App\Order','id');
    }

    public function product()
    {
    	return $thiss->belongsTo('App\Product','id');
    }
}
