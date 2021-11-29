<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductContributorItemRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_contributor_item_relations', function (Blueprint $table) {
            $table->bigIncrements('relation_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('contributor_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('price', 8, 2);
            $table->index('product_id');
            $table->index('contributor_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('contributor_id')->references('contributor_id')->on('contributors')->onDelete('cascade');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_contributor_relations');
    }
}
