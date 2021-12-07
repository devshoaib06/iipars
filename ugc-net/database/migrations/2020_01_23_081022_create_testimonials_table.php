<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_name');
            $table->string('student_course');
            $table->tinyInteger('testimonial_type')->comment="1 For Video,2 For Text";
            $table->text('testimonial_text')->nullable()->default(null);
            $table->text('video_url')->nullable()->default(null);
            $table->tinyInteger('status')->default('1')->comment="1 for Active , 0  for Inactive";
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
        Schema::dropIfExists('testimonials');
    }
}
