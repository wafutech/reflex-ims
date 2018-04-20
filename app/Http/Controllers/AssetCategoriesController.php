<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetCategory;
use Event;
use  App\Events\TransactionLogEvent;
use App\Traits\serialGenerator;
use Auth;
class AssetCategoriesController extends Controller
{
    use serialGenerator;

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = AssetCategory::all();
        return $categories;
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
        $category = new AssetCategory;
        $category->asset_category = $request->input('asset_category');
        $category->description = $request->input('description');
        $category->class_id = $request->input('class_id');
        $category->save();
        $transactionCode = $this->transactionCode();
        $transaction = 'Added Asset Category record: '.$category->asset_category;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        return 'category saved';


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
        $category = AssetCategory::findOrFail($id);
        return $category;

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
               $input = $request->all();
        $category = AssetCategory::findOrFail($id);
        $category->update($input);
        $transactionCode = $this->transactionCode();
        $transaction = 'Updated asset category record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
        return 'Record Updated Successfully!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                $category = AssetCategory::findOrFail($id);
                $category->delete();
                $transactionCode = $this->transactionCode();
        $transaction = 'Deleted fixed Asset Category record with id: '.$id;

        $url = $request->fullUrl();
        Event::Fire(new TransactionLogEvent($transactionCode,$transaction,$url));
                return 'Category Deleted!';

    }
}
