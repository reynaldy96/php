<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSearchUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_search_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')
                ->on('products')->onUpdate('cascade')->onDelete('set null');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');
            $table->integer('province_id')->unsigned()->nullable();
            $table->foreign('province_id')->references('id')
                  ->on('indonesia_provinces')->onUpdate('cascade')->onDelete('set null');
            $table->integer('cities_id')->unsigned()->nullable();
            $table->foreign('cities_id')->references('id')
                  ->on('indonesia_cities')->onUpdate('cascade')->onDelete('set null');
            $table->integer('districts_id')->unsigned()->nullable();
            $table->foreign('districts_id')->references('id')
                 ->on('indonesia_districts')->onUpdate('cascade')->onDelete('set null');
            $table->integer('cod_id')->unsigned()->nullable();
            $table->foreign('cod_id')->references('id')
                 ->on('cod')->onUpdate('cascade')->onDelete('set null');     
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')
                  ->on('brands')->onUpdate('cascade')->onDelete('set null');   
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->foreign('sub_category_id')->references('id')
                ->on('sub_category')->onUpdate('cascade')->onDelete('set null');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')
                ->on('category')->onDelete('cascade');  
            $table->integer('hands_id')->unsigned()->nullable();
            $table->foreign('hands_id')->references('id')
                ->on('hands')->onUpdate('cascade')->onDelete('set null');          
            $table->string('name');
            $table->text('body'); 
            $table->integer('price');
            $table->string('slug');
            $table->text('description');
            $table->boolean('status')->default(0);
            $table->boolean('featured')->default(0);
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_search_user');
    }
}
