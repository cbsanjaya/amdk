<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssembleResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assemble_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assemble_id');
            $table->dateTime('transaction_time');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 13, 2)->nullable();
            $table->string('memo')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('product_id')
                ->references('id')->on('products');
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assemble_results');
    }
}
