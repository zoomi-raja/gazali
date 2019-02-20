<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCompensationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compensations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('u_id');
            $table->integer('type');
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
        Schema::dropIfExists('compensation');
    }

    public function defaultRelation(){
        DB::table('compensations')->insert([
            array(
                'u_id'      => '1',
                'amount'    => 800,
                'type'      => 1
            ),
            array(
                'u_id'      => '2',
                'amount'    => 600,
                'type'      => 2
            )
        ]);
    }

}
