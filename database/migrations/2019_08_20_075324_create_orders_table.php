<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('desen_id');
            $table->integer('order_no');
            $table->integer('firma_no');
            $table->integer('firma_id');
            $table->integer('tesis_id');
            $table->integer('ordertur_id');
            $table->string('en');
            $table->string('boy');
            $table->string('ebatcins_id');
            $table->string('kenartipi_id');
            $table->string('kenarcinsi_id');
            $table->string('miktar');
            $table->string('munit_id');
            $table->date('termin');
            $table->date('siptrh');
            $table->string('renk');
            $table->string('renk2');
            $table->string('const');
            $table->string('fiyat');
            $table->string('kur_id');
            $table->string('vade');
            $table->string('bazkur');
            $table->string('odemesekli');
            $table->lontText('orderadres');
            $table->lontText('sevkiyat');
            $table->lontText('aciklama1');
            $table->lontText('aciklama2');
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
        Schema::dropIfExists('orders');
    }
}
