<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('raw_material_name')->unique();
            $table->string('raw_material_desc')->nullable();
            $table->decimal('quantity_in_hand',2)->default(0.00);
            $table->decimal('starting_value',2)->default(0.00);
            $table->integer('unit_of_measure')->unsigned();
            $table->integer('reorder_level')->unsigned();
            $table->integer('reorder_quantity')->unsigned();  
            $table->integer('prefered_supplier')->unsigned()->default(0);     



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
        Schema::dropIfExists('raw_materials');
    }
}
