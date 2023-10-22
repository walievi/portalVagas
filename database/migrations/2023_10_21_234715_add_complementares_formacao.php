<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComplementaresFormacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formacao', function (Blueprint $table) {
            $table->boolean('lingua_inglesa')->nullable();
            $table->string('local_ingles')->nullable();
            $table->string('duracao_ingles')->nullable();
            $table->boolean('flexRadioDefaultOutroIdioma')->nullable();
            $table->string('outro_idioma')->nullable();
            $table->string('cursos_complementares')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
