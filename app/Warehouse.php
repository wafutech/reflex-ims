<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
   protected $fillable =['warehouse_name','warehouse_code','location'];
}
