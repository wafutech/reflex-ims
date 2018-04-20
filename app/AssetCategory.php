<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    protected $table = 'asset_categories';
    protected $fillabel = ['asset_category','description','class_id'];
    public function assets()
    {
    	return $this->hasMany('App\AssetRegister');
    }

    public function class()
    {
    	return $this->belongsTo('App\AssetClass');
    }
}
