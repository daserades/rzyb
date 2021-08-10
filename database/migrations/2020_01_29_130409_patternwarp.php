<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Patternwarp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patternwarp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('desen_id');
            $table->integer('iplikseridi_id');
            $table->integer('patterndetail_id');
            $table->string('iplikno');
            $table->string('iplikkalin');
            $table->integer('iplikcins_id');
            $table->integer('boyacins_id');
            $table->string('renk_no');
            $table->string('renk');
            $table->integer('harf');
            $table->integer('sayi');
            $table->string('atki_sikligi');
            $table->integer('cozgu_sikligi');
            $table->integer('tekrar');
            $table->integer('bos_atki_sayisi');
            $table->integer('ayni_agiza_atilan_atki_sayisi');
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
        Schema::dropIfExists('patternwarp');
    }
}
