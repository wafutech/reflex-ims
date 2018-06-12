<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawMaterialInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_material_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('raw_material_id')->unique();
                  
            $table->integer('supplier_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();
            $table->integer('unit_of_measure')->unsigned();
            $table->decimal('quantity',2)->default(0.00);
           
            $table->decimal('unit_cost',2)->default(0.00);   
            $table->decimal('amount',2)->default(0.00);
            
                    
            $table->date('purchase_date');

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
        Schema::dropIfExists('raw_material_inventories');
    }
}
