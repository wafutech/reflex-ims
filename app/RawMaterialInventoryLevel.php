<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawMaterialInventoryLevel extends Model
{
    protected $fillable =['raw_material_id','quantity_in_hand_units','quantity_in_hand_value'];

    public function rawmaterial()
    {
    	return $this->belongsTo('App\RawMaterialInventory');
    }
}
