<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoyahanedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boyahanedetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('boyahane_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('metre')->nullable();
            $table->float('kg')->nullable();
            $table->integer('mamulen')->nullable();
            $table->integer('fiyat')->nullable();
            $table->integer('kur_id')->nullable();
            $table->integer('terbiyesureci_id')->nullable();
            $table->longText('aciklama')->nullable();
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
        Schema::dropIfExists('boyahanedetails');
    }
}
