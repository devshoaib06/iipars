<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('company_name',250)->nullable();
            $table->integer('country')->index();
            $table->string('city',8,2);
            $table->string('state',8,2);
            $table->integer('zip',8,2);
            $table->string('phone',20);            
            $table->string('email',250);            
            $table->text('order_notes');            

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('country')->references('id')->on('country_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_details');
    }
}
