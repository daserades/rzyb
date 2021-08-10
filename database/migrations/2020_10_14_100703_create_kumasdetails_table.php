<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKumasdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kumasdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kumas_id');
            $table->integer('order_id')->nullable();
            $table->integer('type')->nullable();
            $table->integer('metre')->nullable();
            $table->integer('mamulen')->nullable();
            $table->float('fiyat')->nullable();
            $table->integer('kur_id')->nullable();
            $table->integer('users_id')->nullable();
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
        Schema::dropIfExists('kumasdetails');
    }
}
