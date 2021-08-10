<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKalitedetaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalitedetays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cozgu_iplik');
            $table->string('cozgu_siklik');
            $table->string('atki_iplik');
            $table->string('atki_siklik');
            $table->string('gsm');
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
        Schema::dropIfExists('kalitedetays');
    }
}
