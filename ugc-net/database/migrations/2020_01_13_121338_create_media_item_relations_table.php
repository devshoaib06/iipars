<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaItemRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_item_relations', function (Blueprint $table) {
            $table->bigIncrements('relation_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('media_id');
            $table->index('item_id');
            $table->index('media_id');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->foreign('media_id')->references('media_id')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_item_relations');
    }
}
