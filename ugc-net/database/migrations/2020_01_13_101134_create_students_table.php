<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('student_id');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('firstname');
            $table->string('lastname');            
            $table->string('contactnumber');
            $table->integer('gender',11)->default(1);            
            $table->string('address');
            $table->integer('country_id');
            $table->ipAddress('ip_address');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
