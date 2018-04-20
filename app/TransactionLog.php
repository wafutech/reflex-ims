<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $fillable =['transaction_code','transaction_details','url','user_id'];
    public function user()
    {
    	return $this->belongsTo('App\User','id');
    }
}
