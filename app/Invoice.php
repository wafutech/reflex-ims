<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable =['order_id','invoice_date'];

    public function order()
    {
    	return $this->belongsTo('App\Order','id');
    }
}
