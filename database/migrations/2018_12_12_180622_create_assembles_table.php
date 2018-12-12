<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssemblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assembles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['manual', 'auto']);
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
        Schema::dropIfExists('assembles');
    }
}
