<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function($table) {
            $table->string('gender')->nullable()->after('contactnumber');
            $table->string('address')->nullable()->after('gender');
            $table->string('country_id')->nullable()->after('address');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function($table) {
            $table->dropColumn('gender');
            $table->dropColumn('address');
            $table->dropColumn('country_id');
        });
    }
}
