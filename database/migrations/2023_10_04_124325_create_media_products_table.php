<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_products', function (Blueprint $table) {
            $table->id();
            $table->string('ImageURL');
            $table->unsignedBigInteger('media_product_id');
            $table->foreign('media_product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('media_products');
    }
}
