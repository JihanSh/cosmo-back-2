<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productTitle')->nullable();
            $table->string('productPrice')->nullable();
            $table->boolean('productVisible')->default(true); 
            $table->string('productDescription')->nullable();
            $table->string('productName')->nullable();
            $table->string('productDesign')->nullable();
            $table->string('productCountry')->nullable();
            $table->string('productWashing')->nullable();
            $table->string('productColor')->nullable();
            $table->string('productFabric')->nullable();
            $table->string('productSKU')->nullable();
            $table->string('productSale')->nullable();
            $table->string('productQuantity')->nullable();
            $table->string('productCurrency')->nullable();
            $table->string('productShipping')->nullable();
            $table->string('productAllowPurchase')->nullable();
            $table->string('productChargetaxes')->nullable();
            $table->string('productWearing')->nullable();
            $table->string('media1')->nullable();
            $table->string('media2')->nullable();
            $table->string('media3')->nullable();
            $table->string('media4')->nullable();
            $table->string('media5')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
           
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
        Schema::dropIfExists('products');
    }
}
