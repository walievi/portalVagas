<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('formularios');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->text('nome_formulario')->collation('utf8mb4_unicode_ci');
            $table->unsignedBigInteger('vaga_id')->nullable();
            $table->timestamps();

            $table->foreign('vaga_id')
                  ->references('id')
                  ->on('vagas')
                  ->onDelete('set null');
        });
    }
}
