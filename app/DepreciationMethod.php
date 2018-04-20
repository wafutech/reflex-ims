<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepreciationMethod extends Model
{
   protected $table = 'depreciation_methods';
    protected $fillable = ['depreciation_method','description'];

     public function asset()
    {
    	return $this->hasMany('App\AssetRegister');
    }
}
