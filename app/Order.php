<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table ='orders';
    protected $fillable = array('id','customer_id','order_date',
    	'ship_date','ship_name','ship_address','ship_city','ship_zip',
    	'ship_fee','payment_method_id','paid_date','notes','user_id','order_status_id','amount');

    public function Customer()
    {
    	return $this->belengsTo('App\Customer','id');
    }
     public function User()
    {
    	return $this->belengsTo('App\User','id');
    }
     public function Paymentmethod()
    {
    	return $this->belengsTo('App\Paymentmethod','id');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem','id');
    }
}
