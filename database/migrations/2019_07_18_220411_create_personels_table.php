<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->bigIncrements('tel');
            $table->integer('departman_tb_id');
            $table->integer('no');
            $table->integer('gorevlistesis_tb_id');
            $table->date('gtrh');
            $table->date('ctrh');
            $table->integer('durums_tb_id');
            $table->integer('users_tb_id');
            $table->longText('adres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personels');
    }
}
