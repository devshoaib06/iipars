<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemContributorRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_contributor_relations', function (Blueprint $table) {
            $table->bigIncrements('relation_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('contributor_id');
            $table->index('item_id');
            $table->index('contributor_id');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->foreign('contributor_id')->references('contributor_id')->on('contributors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_contributor_relations');
    }
}
