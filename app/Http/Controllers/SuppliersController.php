<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;


class SuppliersController extends Controller
{
   use serialGenerator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation_rules = array(

          'first_name'           => 'required|string',
            'last_name'           => 'required|string',

          'mobile_number'           => 'required',
          'work_phone'           => 'string',
          'phone_code'           => 'required|string',
          'fax'           => 'string',
          'email'           => 'required|email',
          'company'           => 'required',
          'postal_address'           => 'string',
          'town'           => 'string',
          'zip'           => 'numeric',
          'phisical_address'           => 'required|string',
         

      );

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return response()->json('Something went wrong');
    }


        $supplier = new Supplier();
         //return $request->input('first_name');
         $supplier->first_name = $request->input('first_name');
         $supplier->last_name = $request->input('last_name');
         $supplier->mobile_number = $request->input('mobile_number');
         $supplier->company = $request->input('company');
         $supplier->work_phone = $request->input('work_phone');
         $supplier->phone_code = $request->input('phone_code');
         $supplier->fax = $request->input('fax');
         $supplier->email = $request->input('email');
         $supplier->postal_address = $request->input('postal_address');
         $supplier->town = $request->input('town');
         $supplier->zip = $request->input('zip');
         $supplier->phisical_address = $request->input('phisical_address');
         $supplier->save();
         $transactionCode = $this->transactionCode();
        $transaction = 'Added new supplier: '.$supplier->first_name.' '.$supplier->last_name.' with id: '.$supplier->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
         return response()->json($supplier);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $supplier = Supplier::findOrFail($id);
            $input = $request->all();
         $supplier->fill($input)->save();
         $transactionCode = $this->transactionCode();
        $transaction = 'Updated supplier record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
         return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $supplier = Supplier::findOrFail($id);
         $supplier->delete();
         $transactionCode = $this->transactionCode();
        $transaction = 'Deleted supplier record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));

         return response()->json('Supplier record removed');
    }
}
