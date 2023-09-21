<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->text('pergunta')->nullable();
            $table->unsignedBigInteger('vaga_id')->nullable(); // Chave estrangeira

            // Definir a chave estrangeira
            $table->foreign('vaga_id')
            ->references('id')
            ->on('vagas')
            ->onDelete('SET NULL'); // Define a ação para quando a vaga for excluída

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
        Schema::dropIfExists('formularios');
    }
}
