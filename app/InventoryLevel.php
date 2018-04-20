<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLevel extends Model
{
    protected $fillable =['product_id','level'];

    public function product()
    {
    	return $this->belongsTo('App\Product','id');
    }
}
