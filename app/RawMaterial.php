<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $fillable = ['raw_material_name','raw_material_desc','quantity_in_hand','starting_value','unit_of_measure',
    'reorder_level',
    'reorder_quantity','prefered_supplier'];


}
