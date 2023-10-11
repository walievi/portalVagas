<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditDadosPessoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_pessoais', function (Blueprint $table) {
            $table->unsignedBigInteger('endereco_id')->nullable()->change();
            $table->unsignedBigInteger('formacao_id')->nullable()->change();
            $table->unsignedBigInteger('contato_id')->nullable()->change();
            $table->unsignedBigInteger('user_id')->nullable()->change();
            
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
