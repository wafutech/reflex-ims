<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BOM extends Model
{
    protected $fillable = ['product_id','raw_material_id','units','unit_of_measure'];
   
   public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function rawmaterial()
    {
    	return $this->belongsTo('App\RawMaterialInventory');
    }
}
