<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControl1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control1s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('control');
            $table->integer('no');
            $table->integer('type');
            $table->datetime('date');
            $table->string('year');
            $table->string('month');
            $table->string('day');
            $table->string('hour');
            $table->string('minute');
            $table->string('second');
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
        Schema::dropIfExists('control1s');
    }
}
