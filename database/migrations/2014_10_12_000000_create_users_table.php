<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('NAME');
            $table->string('LOGIN')->unique();
            $table->string('EMAIL')->unique();
            $table->char('GENDER')->default('M');
            $table->string('PHOTO')->nullable();
            $table->date('DOB');
            $table->string('PASSWORD', 250);
            $table->string('PHONE')->nullable();
            $table->boolean('ACTIVE')->default(true);
            $table->boolean('VERIFIED')->default(false);
            $table->boolean('REMEMBER_TOKEN')->default(false);
            $table->dateTime('CREATED_AT');
            $table->dateTime('UPDATED_AT');
            $table->dateTime('LAST_LOGIN')->nullable();
            $table->rememberToken();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
