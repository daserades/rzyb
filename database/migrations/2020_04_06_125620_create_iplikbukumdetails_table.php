<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIplikbukumdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iplikbukumdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('iplikbukum_id');
            $table->integer('iplikdepo_id');
            $table->integer('iplikirsaliye_id');
            $table->integer('katsayi');
            $table->integer('tur');
            $table->string('yon');
            $table->integer('miktar');
            $table->integer('maxmiktar');
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
        Schema::dropIfExists('iplikbukumdetails');
    }
}
