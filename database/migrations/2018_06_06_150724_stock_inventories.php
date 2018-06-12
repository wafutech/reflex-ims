<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockInventories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->BigInteger('barcode')->unsigned()->unique();
            $table->integer('product_id')->unsigned();
            $table->string('sku')->unique();
            $table->integer('warehouse_id')->unsigned();
             $table->integer('supplier_id')->unsigned();
            $table->integer('on_stock')->unsigned()->default(1);
            $table->decimal('quantity');
            $table->decimal('unit_cost',2);
            $table->decimal('selling_price',2);
            $table->decimal('vat',2);
            $table->date('purchase_date');
            $table->date('expiry_date')->nullable();
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
     Schema::dropIfExists('stock_inventories');

    }
}
