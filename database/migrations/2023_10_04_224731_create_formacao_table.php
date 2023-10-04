<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('local_medio');
            $table->date('ano_conclusao_medio');
            $table->string('curso_superior');
            $table->string('universidade_superior');
            $table->date('ano_conclusao_superior');
            $table->date('data_inicio_superior');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formacao');
    }
}
