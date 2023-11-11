<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransferenciaVagaTableCandidaturaVaga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema :: table ('candidatura_vaga', function (Blueprint $table) {
             $table->unsignedBigInteger('transferencia_vaga');
             $table->foreign('transferencia_vaga')->references('id')->on('vagas');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schemma::table('candidatura_vaga', function (Blueprint $table) {
            $table->dropForeign('candidatura_vaga_transferencia_vaga_foreign');
            $table->dropColumn('transferencia_vaga');
        });
    }
}
