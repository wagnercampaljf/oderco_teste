<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacao_frete', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uf');
            $table->float('percentual_cotacao');
            $table->float('valor_extra');

            $table->integer('transportadora_id')->unsigned();
            $table->foreign('transportadora_id')->references('id')->on('transportadora');
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
        Schema::dropIfExists('cotacao_fretes');
    }
};
