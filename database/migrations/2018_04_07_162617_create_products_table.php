<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
             $table->increments('id');
            $table->string('product_code');
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('product_description');
            $table->integer('unit_id')->unsigned();
            $table->string('quantity_per_unit');
            $table->float('unit_cost');
            $table->float('list_price');
            $table->float('quantity_in_stock');
            $table->integer('reorder_level')->unsigned();
            $table->integer('reorder_quantity')->unsigned();
            $table->integer('min_order')->unsigned();
            $table->string('barcode')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('discontinued')->unsigned()->default(0);
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
        Schema::dropIfExists('products');
    }
}
