<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControl2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control2s', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('control');
            $table->integer('no');
            $table->integer('type');
            $table->datetime('date')->nullable();
            $table->string('year',4)->nullable();
            $table->string('month',2)->nullable();
            $table->string('day',2)->nullable();
            $table->string('hour',2)->nullable();
            $table->string('minute',2)->nullable();
            $table->string('second',2)->nullable();
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
        Schema::dropIfExists('control2s');
    }
}
