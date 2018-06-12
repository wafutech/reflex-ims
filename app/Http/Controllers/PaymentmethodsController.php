<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentMethod;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Auth;

class PaymentmethodsController extends Controller
{
   use serialGenerator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $paymentMethods = PaymentMethod::orderBy('payment_method','asc')->get();
      return response()->json($paymentMethods) ; 
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
         $pm = PaymentMethod::create($request->all);
         $transactionCode = $this->transactionCode();
        $transaction = 'Added payment method record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLog($transactionCode,$transaction,$url));
         return response()->json($pm);
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
    $pm = PaymentMethod::findOrFail($id);
    return $pm;

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
        $pm = PaymentMethod::findOrFail($id);
            $input = $request->all();
         $pm->fill($input)->save();
         $transactionCode = $this->transactionCode();
        $transaction = 'Updated customer: '.$pm->payment_method.' with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLog($transactionCode,$transaction,$url));
         return response()->json($pm);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pm = PaymentMethod::findOrFail($id);
        return $pm->delete();
        $transactionCode = $this->transactionCode();
        $transaction = 'Deleted payment method record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLog($transactionCode,$transaction,$url));
         return response()->json('Payment Method Removed!');
    }
}
