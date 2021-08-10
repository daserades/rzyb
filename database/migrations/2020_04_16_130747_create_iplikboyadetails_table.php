,<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIplikboyadetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iplikboyadetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('iplikboya_id');
            $table->integer('iplikdepo_id');
            $table->integer('iplikirsaliyedetail_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('iplikseridi_id');
            $table->integer('miktar');
            $table->double('fiyat')->nullable();
            $table->integer('kur_id')->nullable();
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
        Schema::dropIfExists('iplikboyadetails');
    }
}
