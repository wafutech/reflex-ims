<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;

class PassportController extends Controller
{
    public $successStatus = 200;
    public $unauthorisedStatus = 401;

    public function login(Request $request)
    {
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    		{
    			$user = Auth::user();
    			$success['token']= $user->createToken('ims')->accessToken;
    			return response()->json(['success'=>$success],$this->successStatus);


    		}

    		else
    		{
    		  return response()->json(['error'=>'Unauthorised'],$this->unauthorisedStatus);

    		}
    }

    //Register user

    public function register(Request $request)
    {
    	
    	$validation_rules = array(

         'name'=>'required|unique:users',
    	'email'=>'required|email|unique:users',
    	'password'=>'required',
    	'confirm_password'=>'required|same:password'
         

      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
       return response()->json(['error'=>$validator->errors(),$this->unauthorisedStatus],$this->unauthorisedStatus);
    }
    	/*$validator = make($request->all(),
    	[
    	'name'=>'required|unique:users',
    	'email'=>'required|email|unique:users',
    	'password'=>'required',
    	'confirm_password'=>'required|same:password'
    	]);

    	if($validator->fails())
    	{
    return response()->json(['error'=>$validator->errors(),$this->unauthorisedStatus],$this->unauthorisedStatus);

    	}*/

    	$input = $request->all();
    	$input['password']= bcrypt($input['password']);
    	$user = User::create($input);
    	$success['token']= $user->createToken('ims')->accessToken;
    	$success['name'] = $user->name;

    	 return response()->json(['success'=>$success],$this->successStatus);


    }

    public function getDetails()
    {
    	$user = Auth::user();

   return response()->json(['success'=>$user],$this->successStatus);


    }
}
