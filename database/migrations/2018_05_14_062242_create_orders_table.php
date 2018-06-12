<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('order_status_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('order_date');
            $table->date('expected_date');
            $table->decimal('amount',2);
            $table->integer('paid')->unsigned()->default(0);
            $table->date('date_paid')->nullable();
            $table->decimal('delivery_fee')->default(0.00);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
