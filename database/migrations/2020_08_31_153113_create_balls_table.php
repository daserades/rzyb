<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uretimtakip_id');
            $table->integer('kumas_id');
            $table->integer('kumasdetail_id');
            $table->integer('kkform_id');
            $table->string('barcode');
            $table->integer('type');
            $table->integer('order_id');
            $table->integer('leventdepo_id');
            $table->string('levent_barcode');
            $table->integer('machine_id');
            $table->integer('metre');
            $table->integer('brutmetre');
            $table->float('kumaseni');
            $table->float('kg');
            $table->varchar('ebat');
            $table->varchar('hamboy');
            $table->integer('durum_id');
            $table->date('trh');
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
        Schema::dropIfExists('balls');
    }
}
