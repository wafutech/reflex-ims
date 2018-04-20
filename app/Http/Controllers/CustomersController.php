<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use serialGenerator;

    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          /* $validation_rules = array(

          'first_name'           => 'required|string',
            'last_name'           => 'required|string',

          'mobile_number'           => 'required',
          'work_phone'           => 'string',
          'phone_code'           => 'required|string',
          'fax'           => 'string',
          'email'           => 'required|email',
          'postal_address'           => 'string',
          'town'           => 'string',
          'zip'           => 'numeric',
          'phisical_address'           => 'required|string',
         

      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return response()->json('Something went wrong');
    }*/



        $customer = new Customer();
         //return $request->input('first_name');
         $customer->first_name = $request->input('first_name');
         $customer->last_name = $request->input('last_name');
         $customer->mobile_number = $request->input('mobile_number');
         $customer->company = $request->input('company');
         $customer->work_phone = $request->input('work_phone');
         $customer->phone_code = $request->input('phone_code');
         $customer->fax = $request->input('fax');
         $customer->email = $request->input('email');
         $customer->postal_address = $request->input('postal_address');
         $customer->town = $request->input('town');
         $customer->zip = $request->input('zip');
         $customer->phisical_address = $request->input('phisical_address');
         $customer->save();
         $transactionCode = $this->transactionCode();
        $transaction = 'Added new customer: '.$customer->first_name.' '.$customer->last_name.' with id: '.$customer->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
         return response()->json($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return $customer;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $customer = Customer::findOrFail($id);
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
            $input = $request->all();
         $customer->update($input);
         $transactionCode = $this->transactionCode();
        $transaction = 'Updated customer: '.$customer->first_name.' with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
         return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Product::findOrFail($id);

    
         $transactionCode = $this->transactionCode();
        $transaction = 'Deleted customer: '.$customer->name.' with id: '.$id;
        
        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        $customer->delete();

    return response()->json('Customer record removed');
    }
}
