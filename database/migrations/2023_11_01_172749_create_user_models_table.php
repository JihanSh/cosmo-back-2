<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_models', function (Blueprint $table) {
            $table->id();
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('gender')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address');
            $table->string('apartment')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('zip_code');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_models');
    }
}
