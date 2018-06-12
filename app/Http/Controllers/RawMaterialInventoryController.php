<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RawMaterialInventory;
use App\RawMaterialInventoryLevel;
use Auth;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;

class RawMaterialInventoryController extends Controller
{
           use serialGenerator;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rawMaterials = RawMaterialInventory::all();
        return $rawMaterials;
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

          'raw_material_name'=>'required|string|unique:raw_materials_inventories',
          'supplier_id'           => 'required',

          'starting_quantity'           => 'required',
          'unit_cost'           => 'required',
          'raw_material_desc'           => 'string',
          'purchase_date'           => 'required|date',
          'reorder_quantity'=>'required|numeric',
          'min_order'=>'required|numeric',
          'reorder_level'=>'required|numeric',
          'unit_of_measure'=>'required',
                   

      );

       

    $validator = Validator::make(Input::all(), $validation_rules);

     // Return back to form w/ validation errors & session data as input

     if($validator->fails()) {

     
        return $validator->messages();
    }
    $rawmaterial = new RawMaterialInventory;
    $rawmaterial->raw_material_id = $request->raw_material_id;    
    $rawmaterial->supplier_id = $request->supplier_id;
    $rawmaterial->quantity= $request->quantity;
    $rawmaterial->unit_cost = $request->unit_cost;
    $rawmaterial->purchase_date = $request->purchase_date;
    $rawmaterial->unit_of_measure = $request->unit_of_measure;
    $rawmaterial->warehouse_id = $request->warehouse_id;
    $rawmaterial->amount = $request->quantity*$request->unit_cost;
    $rawmaterial->save();
    //update new raw material levels;
    $material = RawMaterialInventoryLevel::where('raw_material_id',$rawmaterial->raw_material_id)->first();

    if($material)
    {
        $material_unit_bal = $material->quantity_in_hand_units+$rawmaterial->quantity;
        $val_bal = $material->  $quantity_in_hand_value+$rawmaterial->amount;
      //Save initial raw material bal
     DB::update('update raw_material_inventory_levels set quantity_in_hand_units=?,quantity_in_hand_value=?, where raw_material_id =?',[$material_unit_bal,$val_bal]);
     
    }   

        $transactionCode = $this->transactionCode();
        $transaction = 'Received Raw Material Inventory Item: with id: '.$rawmaterial->id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
       
    
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
        $rawmaterial = RawMaterialInventory::find($id);
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
        $rawmaterial = RawMaterialInventory::find($id);
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
        $rawmaterial = RawMaterialInventory::find($id);
        $input = $request->all();
        $rawMaterial->update($input);
        return 'Record Updated';
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $rawmaterial = RawMaterialInventory::find($id);
         $rawmaterial->delete();
         return 'Record Delete!';
    }
}
