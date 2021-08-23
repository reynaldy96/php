<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsThumbnailImagesTable extends Migration
{
    /**
     * Run the migrations. product_search_user
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_thumbnail_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')
                ->on('products')->onUpdate('cascade')->onDelete('set null');
            $table->integer('product_search_user_id')->unsigned()->nullable();
            $table->foreign('product_search_user_id')->references('id')
                ->on('product_search_user')->onUpdate('cascade')->onDelete('set null');
            $table->string('thumbnail_product_image_path');
            $table->string('thumbnail_product_image_caption')->nullable();
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
        Schema::dropIfExists('products_thumbnail_images');
    }
}
