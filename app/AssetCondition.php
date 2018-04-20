<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetCondition extends Model
{
    protected $table = 'asset_conditions';
    protected $fillable = ['condition'];

    public function asset()
    {
    	return $this->hasMany('App\AssetRegister');
    }
}
