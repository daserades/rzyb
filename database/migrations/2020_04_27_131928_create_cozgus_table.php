<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCozgusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cozgus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no');
            $table->integer('firma_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('telsayi')->nullable();
            $table->integer('leventeni')->nullable();
            $table->integer('metraj')->nullable();
            $table->integer('bobinadet')->nullable();
            $table->integer('tip')->nullable();
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
        Schema::dropIfExists('cozgus');
    }
}
