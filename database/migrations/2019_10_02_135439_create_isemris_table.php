<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIsemrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isemris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no');
            $table->integer('desen_id');
            $table->integer('leventadet');
            $table->float('parca_sayisi');
            $table->integer('cozgu_metre');
            $table->float('sip_fazlasi');
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
        Schema::dropIfExists('isemris');
    }
}
