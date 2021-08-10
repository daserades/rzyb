<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIplikirsaliyesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iplikirsaliyes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hareketturu_id');
            $table->integer('order_id')->nullable();
            $table->integer('firma_id')->nullable();
            $table->date('ctrh')->nullable();
            $table->integer('firmatipi_id')->nullable();
            $table->integer('fiyat')->nullable();
            $table->integer('kur_id')->nullable();
            $table->string('irsaliye_no')->nullable();
            $table->string('fatura_no')->nullable();
            $table->longText('aciklama')->nullable();
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
        Schema::dropIfExists('iplikirsaliyes');
    }
}
