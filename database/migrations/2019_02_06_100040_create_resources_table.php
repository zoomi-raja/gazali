<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('NAME');
            $table->string('KEY');
            $table->dateTime('CREATED_AT')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('UPDATED_AT')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        //default groups
        $this->addDefaultResources();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }

    protected function addDefaultResources(){
        DB::table('resources')->insert([
            array(
                'NAME'  => 'User',
                'KEY'   => 'USER',
            ),
            array(
                'NAME'  => 'Resource',
                'KEY'   => 'RESOURCE',
            ),
            array(
                'NAME'  => 'Group',
                'KEY'   => 'GROUP',
            ),
            array(
                'NAME'  => 'Role',
                'KEY'   => 'ROLE',
            ),
            array(
                'NAME'  => 'Student',
                'KEY'   => 'STUDENT',
            ),
            array(
                'NAME'  => 'Class',
                'KEY'   => 'CLASS',
            ),
            array(
                'NAME'  => 'School',
                'KEY'   => 'SCHOOL',
            )
        ]);
    }
}
