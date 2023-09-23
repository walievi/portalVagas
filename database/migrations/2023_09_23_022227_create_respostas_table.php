<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pergunta_id');
            $table->unsignedBigInteger('vaga_id');
            $table->unsignedBigInteger('user_id');
            $table->text('resposta', 1024)->nullable();
            $table->timestamps();

           $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade');
           $table->foreign('pergunta_id')->references('id')->on('perguntas');
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respostas');
    }
}
