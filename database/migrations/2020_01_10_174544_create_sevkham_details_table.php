<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSevkhamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sevkham_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sevkham_id');
            $table->integer('kkform_id');
            $table->integer('order_id');
            $table->string('barcode')->nulalble();
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
        Schema::dropIfExists('sevkham_details');
    }
}
