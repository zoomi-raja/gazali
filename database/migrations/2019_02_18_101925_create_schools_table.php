<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('active')->default(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        //default groups
        $this->addDefaultSchool();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }

    public function addDefaultSchool(){
        DB::table('schools')->insert([
            array(
                'name'      => 'Gazali Sarai alamgir',
                'address'   => 'Sarai',
                'phone'     => '030095255411',
                'website'   => 'gazalisarai.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        ]);
    }
}
