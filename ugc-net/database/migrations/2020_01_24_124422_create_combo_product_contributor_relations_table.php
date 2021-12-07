<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboProductContributorRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_product_contributor_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('combo_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('contributor_id');
            $table->foreign('combo_id')->references('combo_id')->on('combo_products');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('contributor_id')->references('contributor_id')->on('contributors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combo_product_contributor_relations');
    }
}
