<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCozgudetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cozgudetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cozgu_id')->nullable();
            $table->integer('hareketturu_id')->nullable();
            $table->integer('iplikirsaliye_id')->nullable();
            $table->integer('iplikirsaliyedetail_id')->nullable();
            $table->integer('sira')->nullable();
            $table->string('barcode')->nullable();
            $table->string('iplikmarka')->nullable();
            $table->integer('iplikcins_id')->nullable();
            $table->integer('boyacins_id')->nullable();
            $table->integer('iplikno')->nullable();
            $table->integer('ne')->nullable();
            $table->string('renk')->nullable();
            $table->string('renkno')->nullable();
            $table->string('renksim')->nullable();
            $table->string('renknosim')->nullable();
            $table->string('partino')->nullable();
            $table->double('miktar')->nullable();
            $table->double('brutmiktar')->nullable();
            $table->integer('unit_id')->nullable();
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
        Schema::dropIfExists('cozgudetails');
    }
}
