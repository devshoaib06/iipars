<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseStructureRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_structure_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('exam_id')->index();
            $table->unsignedBigInteger('paper_id')->index();
            $table->unsignedBigInteger('subject_id')->index();
            $table->unsignedBigInteger('material_id')->index();
            $table->decimal('price', 8, 2);
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exam_masters')->onDelete('cascade');
            $table->foreign('paper_id')->references('id')->on('paper_masters')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subject_masters')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('material_masters')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_structure_relations');
    }
}
