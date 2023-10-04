<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosPessoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_pessoais', function (Blueprint $table) {
            $table->id();
            $table->date('data_nascimento');
            $table->unsignedBigInteger('endereco_id');
            $table->unsignedBigInteger('formacao_id');
            $table->unsignedBigInteger('contato_id');
            $table->unsignedBigInteger('user_id');
            $table->text('objetivo_vaga');
            $table->text('habilidades');
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->foreign('formacao_id')->references('id')->on('formacao');
            $table->foreign('contato_id')->references('id')->on('contatos');
            $table->foreign('user_id')->references('id')->on('users');            
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
        Schema::dropIfExists('dados_pessoais');
    }
}