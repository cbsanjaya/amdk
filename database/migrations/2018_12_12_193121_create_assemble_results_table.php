<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
