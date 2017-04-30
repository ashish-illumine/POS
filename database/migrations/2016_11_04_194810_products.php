<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('product_name', 100);
            $table->string('product_desc', 500);
            $table->integer('product_quantity');
            $table->float('product_price');
            $table->boolean('is_active');
            $table->boolean('is_avilable');
            $table->timestamps();
            $table->foreign('category_id')
              ->references('id')->on('categories')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
