<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
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
             $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_number');
            $table->string('work_phone');
            $table->integer('phone_code');
            $table->string('fax')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('postal_address')->nullable();
            $table->string('town')->nullable();
            $table->integer('zip')->unsigned()->nullable();
            $table->string('phisical_address')->nullable();
            $table->string('company')->nullable();
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
        //
    }
}
