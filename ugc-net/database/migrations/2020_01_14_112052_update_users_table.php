<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
             $table->unsignedBigInteger('user_type_id')->index();
             $table->boolean('status')->after('user_type_id');
             $table->boolean('is_approved')->after('status');
             $table->foreign('user_type_id')->references('id')->on('user_types');
          });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
