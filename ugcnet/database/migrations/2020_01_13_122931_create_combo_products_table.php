<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('combo_products', function (Blueprint $table) {
            $table->bigIncrements('combo_id');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('product_id');
            $table->index('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });*/

        Schema::create('combo_products', function (Blueprint $table) {
            $table->bigIncrements('combo_id');
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->text('short_description');
            $table->text('description');
            $table->text('important_notice');
            $table->decimal('price', 8, 2);
            $table->decimal('discount_price', 8, 2);
            $table->date('expiry_date');
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
        Schema::dropIfExists('combo_products');
    }
}
