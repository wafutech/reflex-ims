<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    protected $fillable = ['cat_name','description'];
    public function inventories()
    {
    	return $this->hasMany('\App\Inventory');
    }
}
