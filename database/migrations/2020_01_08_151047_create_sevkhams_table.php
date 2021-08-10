<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSevkhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sevkhams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('firma_id');
            $table->integer('firmatipi_id');
            $table->date('trh')->nullable();
            $table->longText('adres')->nullable();
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
        Schema::dropIfExists('sevkhams');
    }
}
