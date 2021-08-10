<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIplikirsaliyedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iplikirsaliyedetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('iplikirsaliye_id');
            $table->integer('barcode');
            $table->integer('iplikno')->nullable();
            $table->integer('ne')->nullable();
            $table->string('renk')->nullable();
            $table->string('renkno')->nullable();
            $table->string('partino')->nullable();
            $table->integer('miktar')->nullable();
            $table->integer('brutmiktar')->nullable();
            $table->integer('unit_id')->nullable();
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
        Schema::dropIfExists('iplikirsaliyedetails');
    }
}
