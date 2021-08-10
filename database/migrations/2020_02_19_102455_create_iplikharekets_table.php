<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIplikhareketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iplikharekets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('barcode');
            $table->integer('hareketturu_id');
            $table->integer('order_id')->nullable();
            $table->integer('iplikdepo_id')->nullable();
            $table->integer('firma_id')->nullable();
            $table->date('gtrh')->nullable();
            $table->date('ctrh')->nullable();
            $table->integer('firmatipi_id')->nullable();
            $table->integer('iplikcins_id')->nullable();
            $table->integer('boyacins_id')->nullable();
            $table->integer('iplikno')->nullable();
            $table->integer('ne')->nullable();
            $table->string('renk')->nullable();
            $table->string('renkno')->nullable();
            $table->string('partino')->nullable();
            $table->integer('miktar')->nullable();
            $table->integer('brutmiktar')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('fiyat')->nullable();
            $table->integer('kur_id')->nullable();
            $table->string('irsaliye_no')->nullable();
            $table->string('fatura_no')->nullable();
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
        Schema::dropIfExists('iplikharekets');
    }
}
