<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =['business_name','business_address','contact_phone','contact_email','company_logo','tag_line'];
}
