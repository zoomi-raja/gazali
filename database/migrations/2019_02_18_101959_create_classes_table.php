<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        $this->addDefaultClass();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
    public function addDefaultClass(){
        DB::table('classes')->insert([
            array(
                'name'      => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '6',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '7',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '8',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => '9',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name'      => 'matric',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        ]);
    }
}
