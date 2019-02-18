<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CreateClassSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_school', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('c_id');
            $table->integer('s_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        $this->defaultRelation();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_school');
    }

    public function defaultRelation(){
        DB::table('class_school')->insert([
            array(
                's_id'      => '1',
                'c_id'      => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '4',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '6',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '7',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '8',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => '9',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                's_id'      => '1',
                'c_id'      => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        ]);
    }
}
