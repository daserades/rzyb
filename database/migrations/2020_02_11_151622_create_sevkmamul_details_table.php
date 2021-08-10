<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSevkmamulDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sevkmamul_details', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->integer('sevkmamul_id');
            $table->integer('mamulkkform_id');
            $table->integer('order_id');
            $table->string('barkod')->nulalble();
            $table->integer('top_id');
            $table->integer('metre');
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
        Schema::dropIfExists('sevkmamul_details');
    }
}
