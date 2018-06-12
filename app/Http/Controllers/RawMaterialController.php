<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RawMaterial;
use App\RawMaterialInventoryLevel;
use Validator;
use DB;
use Auth;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Illuminate\Support\Facades\Input;


class RawMaterialController extends Controller
{
    
           use serialGenerator;
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rawMaterials = RawMaterial::all();
        return $rawMaterials;
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
        $validation_rules = array(

          'raw_material_name'=>'required|string|unique:raw_materials',

          'quantity_in_hand'           => 'required',
          'raw_material_desc'           => 'string',
          'reorder_level'=>'required|numeric',
          'unit_of_measure'=>'required',
          'starting_value'=>'required|numeric',
          'reorder_quantity'=>'required|numeric',
          'prefered_supplier'=>'required',


      );

       

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return $validator->messages();
    }

    $rawmaterial = new RawMaterial;
    $rawmaterial->raw_material_name = $request->raw_material_name;
    $rawmaterial->raw_material_desc = $request->raw_material_desc;
    $rawmaterial->prefered_supplier = $request->prefered_supplier;
    $rawmaterial->quantity_in_hand= $request->quantity_in_hand;
    $rawmaterial->starting_value= $request->starting_value;
    $rawmaterial->reorder_quantity = $request->reorder_quantity;
    $rawmaterial->reorder_level = $request->reorder_level;
    $rawmaterial->unit_of_measure = $request->unit_of_measure;
    $rawmaterial->save();
    
      //Savel initial raw material bal
     $rawMaterialBal = new RawMaterialInventoryLevel;
      $rawMaterialBal->raw_material_id = $rawmaterial->id;
       $rawMaterialBal->quantity_in_hand_units =$rawmaterial->quantity_in_hand; 
        $rawMaterialBal->quantity_in_hand_value =$rawmaterial->starting_value;
        $rawMaterialBal->save();


  
    
    return $rawmaterial;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rawmaterial = RawMaterial::find($id);
        return $rawmaterial;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rawmaterial = RawMaterial::find($id);
        return $rawmaterial;
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
        $rawmaterial = RawMaterial::find($id);

        $input = $request->all();
        $rawmaterial->update($input);
        return $rawmaterial;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rawmaterial = RawMaterial::find($id);
        $rawmaterial->delete();
        return 'Record Removed!';
    }
}
