<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name');
            $table->string('telephone')->nullable();
            $table->string('mobile_number');
            $table->string('country')->nullable();
            $table->integer('phone_code');

             $table->string('contact_title')->nullable();
             $table->string('contact_name')->nullable();

            $table->string('work_phone');
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('town')->nullable();
            $table->integer('zip')->unsigned()->nullable();
            $table->string('phisical_address')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
