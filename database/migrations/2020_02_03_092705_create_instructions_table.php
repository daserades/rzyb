<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('desen_id');
            $table->integer('order_id');
            $table->integer('patterndetail_id');
            $table->integer('sumcozgutel');
            $table->integer('cozgumetraji');
            $table->integer('cozguhasilfire');
            $table->integer('iplikboyafire');
            $table->float('netkg');
            $table->float('kazankg');
            $table->float('mtulgr');
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
        Schema::dropIfExists('instructions');
    }
}
