<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('NAME');
            $table->string('KEY');
            $table->dateTime('CREATED_AT')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('UPDATED_AT')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        //default groups
        $this->addDefaultGroups();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }

    protected function addDefaultGroups(){
        DB::table('groups')->insert([
            array(
                'NAME'  => 'Super Admin',
                'KEY'   => 'SUPER_ADMIN',
            ),
            array(
                'NAME'  => 'Admin',
                'KEY'   => 'ADMIN',
            ),
            array(
                'NAME'  => 'Teacher',
                'KEY'   => 'TEACHER',
            ),
            array(
                'NAME'  => 'Student',
                'KEY'   => 'STUDENT',
            )
        ]);
    }
}
