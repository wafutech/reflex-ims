<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Validator;

class SettingController extends Controller
{
    //


    public function requestSettings()
    {
    	$settings = Setting::all()->limit(1);
    	return $settings;
    }

    public function setUp(Request $request)

    {
    	 $validation_rules = array(

            'business_name'   => 'required|string',
            'business_address'   => 'required|string',
            'contact_phone' =>'required|numeric',
            'contact_email'=>'required|email',
            'company_logo' => 'image|mime:jpg,jpeg,gif,png',
            


      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return $validator->messages();
    }

    //check if a business name already exists
    $exists = Setting::all();
    if($exists)
    {
    	return 'Business credentials already Set!';
    }

    //Save new settings

    $setting = new Setting;
    $setting->business_name = $request->business_name;
    $setting->business_address = $request->business_address;
    $setting->tag_line = $request->tag_line;
    $setting->contact_phone = $request->contact_phone;
    $setting->contact_email = $request->contact_email;
    $setting->save();
    
    return $setting;
    }
}
