<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExamPaperMaterialRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_paper_material_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('exam_id')->index();
            $table->unsignedBigInteger('paper_id')->index();
            $table->text('material_list');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('exam_masters')->onDelete('cascade');
            $table->foreign('paper_id')->references('id')->on('paper_masters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_masters');
    }
}
