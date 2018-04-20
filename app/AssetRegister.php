<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    protected $table = 'asset_register';
    
    protected $fillable =['asset_description','category_id','phisical_location','asset_no','serial_no','acquisition_date','model','acquisition_cost','depreciation_method_id','useful_years','salvage_value','previous_depreciation','closing_bal','depreciation_in_this_period','asset_condintion_id','supplier_id'];

   

    public function condition()
    {
    	return $this->hasOne('App\AssetCondition');
    }

     public function depreciaptionMethod()
    {
    	return $this->hasOne('App\DepreciationMethod');
    }

     

    public function category()
    {
    	return $this->belongsTo('App\AssetCategory');
    }

    public function supplier()
    {
    	return $this->belongsTo('App\Suplier');
    }
}
