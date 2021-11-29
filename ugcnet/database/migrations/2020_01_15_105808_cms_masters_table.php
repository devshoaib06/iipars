<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CmsMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_masters', function (Blueprint $table) {
            $table->bigIncrements('cms_id');
            $table->string('url');
            $table->string('heading')->nullable();
            $table->text('description');
            $table->text('meta_title');
            $table->text('meta_keyword');
            $table->text('meta_description')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('cms_masters');
    }
}
