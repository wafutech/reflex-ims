<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_register', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('asset_description');
           $table->integer('asset_condintion_id')->unsigned();
            $table->string('phisical_location');
            $table->string('asset_no')->unique();
            $table->string('serial_no')->nullable();
            $table->string('model')->nullable();
            $table->date('acquisition_date');
            $table->decimal('acquisition_cost',2);
            $table->integer('supplier_id')->unsigned();
            $table->integer('depreciation_method_id')->unsigned();
            $table->string('useful_years');
            $table->decimal('salvage_value');
             $table->decimal('previous_depreciation');
            $table->decimal('depreciation_in_this_period');
            $table->decimal('closing_bal',2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_register');
    }
}
