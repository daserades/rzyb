<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdetailweftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetailwefts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('desen_id')->nullable();
            $table->integer('sira');
            $table->string('cinsne')->nullable();
            $table->string('renkno')->nullable();
            $table->string('renk')->nullable();
            $table->integer('boyanankg')->nullable();
            $table->integer('gelenkg')->nullable();
            $table->integer('siklik')->nullable();
            $table->integer('users_id');
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
        Schema::dropIfExists('orderdetailwefts');
    }
}
