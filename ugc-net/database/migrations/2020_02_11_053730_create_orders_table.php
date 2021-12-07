<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('order_id',100);
            $table->unsignedBigInteger('student_id')->index();
            $table->unsignedBigInteger('course_id')->index();
            $table->string('payment_order_id',100);
            $table->string('p_gateway_payment_id',100)->nullable();
            $table->decimal('subtotal',8,2);
            $table->decimal('discount_amount',8,2)->nullable();
            $table->decimal('grand_total',8,2);
            $table->string('currency',100)->default('INR');
            $table->string('payment_status',100);
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('product_id')->on('products')->onDelete('cascade');
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
