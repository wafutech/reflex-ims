<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
   protected $table ='stock_inventories';
   
    
    protected $fillable =['barcode','product_id','warehouse','supplier_id','quantity','unit_cost','selling_price','vat','purchase_date','expiry_date','on_stock','sku'];

    public function product()
    {
    	return $this->belongsTo('App\Product');

    }

    public function supplier()
    {
    	return $this->belongsTo('App\Supplier');

    }

    public function units()
    {
    	return $this->belongsTo('App\UnitMeasure');

    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
