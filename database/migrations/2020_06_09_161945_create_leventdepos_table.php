<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeventdeposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leventdepos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->nulllable();
            $table->string('barcode')->nulllable();
            $table->integer('leventirsaliye_id')->nulllable();
            $table->integer('no')->nullable();
            $table->integer('cozgu_id')->nullable();
            $table->integer('telsayi')->nullable();
            $table->integer('leventeni')->nullable();
            $table->integer('metraj')->nullable();
            $table->integer('kg')->nullable();
            $table->integer('durum_id')->nullable();
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
        Schema::dropIfExists('leventdepos');
    }
}
