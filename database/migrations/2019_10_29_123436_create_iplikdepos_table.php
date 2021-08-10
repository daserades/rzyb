<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIplikdeposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iplikdepos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('barcode');
            $table->integer('iplikhareket_id');
            $table->integer('order_id');
            $table->integer('iplikcins_id');
            $table->integer('boyacins_id');
            $table->integer('firma_id');
            $table->integer('iplikno');
            $table->integer('ne');
            $table->string('renk');
            $table->string('renkno');
            $table->string('partino');
            $table->integer('miktar');
            $table->integer('brutmiktar');
            $table->integer('unit_id');
            $table->integer('fiyat');
            $table->integer('kur_id');
            $table->integer('irsaliye_no');
            $table->integer('fatura_no');
            $table->longText('aciklama');
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
        Schema::dropIfExists('iplikdepos');
    }
}
