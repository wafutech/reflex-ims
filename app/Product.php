<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table ='products';
    protected $fillable = array('id','product_name','product_description','category_id',
    	'product_code','min_order','supply_capacity','quantity_in_stock',
    	'unit_cost','list_price','reorder_level','reorder_quantity','unit_cost','barcode','user_id','unit_id','quantity_per_unit','discontinued');

    public function ProductCategory()
    {
    	return $this->belongTo('App\ProductCategory','id');
    }
    public function unit()
    {
        return $this->belongTo('App\UnitMeasure','id');
    }
    public function  Order()
    {
    	return $this->hasMany('App\Order','id');
    }
}
