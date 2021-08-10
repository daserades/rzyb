,<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeventhareketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leventharekets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->nulllable();
            $table->string('barcode')->nulllable();
            $table->integer('leventirsaliye_id')->nulllable();
            $table->integer('hareketturu_id')->nulllable();
            $table->integer('machine_id')->nulllable();
            $table->integer('no')->nullable();
            $table->integer('cozgu_id')->nullable();
            $table->integer('telsayi')->nullable();
            $table->integer('leventeni')->nullable();
            $table->integer('metraj')->nullable();
            $table->integer('kg')->nullable();
            $table->double('fiyat')->nullable();
            $table->integer('kur_id')->nullable();
            $table->integer('users_id')->nullable();
            $table->longText('aciklama')->nullable();
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
        Schema::dropIfExists('leventharekets');
    }
}
