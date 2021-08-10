<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeventirsaliyesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leventirsaliyes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hareketturu_id');
            $table->integer('firmatipi_id');
            $table->integer('firma_id');
            $table->date('gtrh')->nullable();
            $table->date('ctrh')->nullable();
            $table->integer('barcode_adet')->nullable();
            $table->integer('irsaliye_no')->nullable();
            $table->integer('fatura_no')->nullable();
            $table->longText('aciklama')->nullable();
            $table->integer('users_id')->nullable();
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
        Schema::dropIfExists('leventirsaliyes');
    }
}
