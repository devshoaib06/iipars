<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('product_id');
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->text('short_description');
            $table->text('description');
            $table->text('important_notice');
            $table->decimal('price', 8, 2);
            $table->decimal('revised_price', 8, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_popular')->default(0);
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->string('meta_key');
            $table->boolean('home_slider')->default(0);
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
