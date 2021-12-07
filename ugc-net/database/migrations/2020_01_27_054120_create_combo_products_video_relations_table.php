<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboProductsVideoRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_products_video_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('combo_id');
            $table->unsignedBigInteger('video_id');
            $table->foreign('combo_id')->references('combo_id')->on('combo_products')->onDelete('cascade');
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combo_products_video_relations');
    }
}
