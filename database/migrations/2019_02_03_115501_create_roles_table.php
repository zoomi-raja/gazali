<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('SCHOOL_ID');
            $table->string('RESOURCE');
            $table->boolean('VIEW');
            $table->boolean('ADD');
            $table->boolean('UPDATE');
            $table->dateTime('CREATED_AT');
            $table->dateTime('UPDATED_AT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
