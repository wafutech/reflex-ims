<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawMaterialInventory extends Model
{
    protected $fillable = ['raw_material_name','raw_material_desc','supplier_id','warehouse_id','unit_of_measure','starting_quantity','unit_cost','reorder_level','reorder_quantity','min_order','purchase_date'];

    public function supplier()
    {
    	return $this->belongsTo('App\Supplier');
    }

    public function warehouse()
    {
    	return $this->belongsTo('App\Warehouse');
    }

    public function unitmeasure()
    {
    	return $this->belongsTo('App\UnitMeasure');
    }
}
