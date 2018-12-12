<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_mutations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->string('group')
                ->comment('group dari transaksi');
            $table->string('reference')->unique()
                ->comment('referensi ke transaksi jenis:id');
            $table->integer('quantity')
                ->comment('+ untuk masuk dan - untuk keluar');
            $table->string('period')
                ->comment('periode mutasi perbulan');
            $table->timestamp('at');
            $table->foreign('product_id')
                ->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_mutations');
    }
}
