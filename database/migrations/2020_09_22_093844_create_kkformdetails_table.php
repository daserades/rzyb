<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkformdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkformdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kkform_id');
            $table->integer('metre')->nullable();
            $table->integer('hatalist_id')->nullable();
            $table->integer('hatapuan_id')->nullable();
            $table->integer('vardiya1_id')->nullable();
            $table->integer('vardiya2_id')->nullable();
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
        Schema::dropIfExists('kkformdetails');
    }
}
