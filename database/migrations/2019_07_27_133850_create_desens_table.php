<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('no');
            $table->string('atki_sikligi');
            $table->string('cozgu_sikligi');
            $table->string('cts');
            $table->string('tarak_eni');
            $table->string('faydali_tarak_eni');
            $table->string('tarak');
            $table->string('tarak_no');
            $table->string('ham_en');
            $table->string('ham_boy');
            $table->string('ham_gr');
            $table->string('mamul_en');
            $table->string('mamul_boy');
            $table->string('mamul_gr');
            $table->string('tahar');
            $table->string('cozgu');
            $table->string('kenargenisligi');
            $table->longText('aciklama');
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
        Schema::dropIfExists('desens');
    }
}
