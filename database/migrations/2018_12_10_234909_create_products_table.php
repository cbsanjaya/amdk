<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('description');
            $table->string('unit');
            $table->decimal('cost_price', 13, 2)->default(0);
            $table->decimal('price', 13, 2)->default(0);
            $table->boolean('tobuy')->default(false);
            $table->boolean('tosell')->default(false);
            $table->boolean('raw')->default(false)->comment('bahan baku?');
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
