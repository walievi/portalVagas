<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntaVagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pergunta_vaga', function (Blueprint $table) {
           $table->unsignedBigInteger('pergunta_id');
           $table->unsignedBigInteger('vaga_id');
           $table->boolean('required')->default(false);

           $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade');
           $table->foreign('pergunta_id')->references('id')->on('perguntas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pergunta_vaga');
    }
}
