<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCategoryDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_department', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
           $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           $table->unsignedBigInteger('department_id');
           $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
           $table->boolean('visibility')->default(true);
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
        Schema::dropIfExists('category_department');
    }
}
