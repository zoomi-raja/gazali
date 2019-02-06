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
            $table->integer('U_ID');
            $table->integer('S_ID');
            $table->integer('R_ID');
            $table->boolean('VIEW');
            $table->boolean('ADD');
            $table->boolean('UPDATE');
            $table->dateTime('CREATED_AT')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('UPDATED_AT')->default(DB::raw('CURRENT_TIMESTAMP'));
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
