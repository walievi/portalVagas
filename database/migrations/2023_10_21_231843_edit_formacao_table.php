<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFormacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('formacao');

        Schema::create('formacao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('local_medio');
            $table->date('ano_conclusao_medio');
            $table->string('curso_superior');
            $table->string('universidade_superior');
            $table->date('ano_conclusao_superior');
            $table->date('data_inicio_superior');
            $table->unsignedBigInteger('user_id');
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
        //
    }
}
