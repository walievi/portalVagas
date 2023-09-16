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
            $table->string('nome_completo');
            $table->date('data_nascimento');
            $table->integer('idade');
            $table->string('telefone');
            $table->string('email');
            $table->text('endereco');
            $table->text('objetivo_vaga');
            $table->text('habilidades');
            $table->string('ensino_medio_local');
            $table->string('ensino_medio_curso');
            $table->integer('ensino_medio_ano_conclusao');
            $table->string('ensino_superior_curso')->nullable();
            $table->string('ensino_superior_universidade')->nullable();
            $table->date('ensino_superior_data_inicio')->nullable();
            $table->date('ensino_superior_previsao_conclusao')->nullable();
            $table->boolean('curso_graduacao')->default(false);
            $table->string('curso_graduacao_curso')->nullable();
            $table->string('curso_graduacao_universidade')->nullable();
            $table->date('curso_graduacao_data_inicio')->nullable();
            $table->date('curso_graduacao_data_conclusao')->nullable();
            $table->boolean('curso_ingles')->default(false);
            $table->text('curso_ingles_local')->nullable();
            $table->string('curso_ingles_duracao')->nullable();
            $table->boolean('fluencia_outro_idioma')->default(false);
            $table->string('outro_idioma')->nullable();
            $table->text('cursos_complementares')->nullable();
            $table->boolean('experiencia_auxiliar_desenvolvimento_escolar')->default(false);
            $table->string('tempo_experiencia_auxiliar_desenvolvimento_escolar')->nullable();
            $table->enum('nivel_ensino_experiencia_auxiliar_desenvolvimento_escolar', [
                'Educação Infantil',
                'Ensino fundamental - Anos Iniciais',
                'Ensino fundamental - Anos Finais',
                'Ensino Médio',
            ])->nullable();
            $table->boolean('experiencia_docente_titular')->default(false);
            $table->string('tempo_experiencia_docente_titular')->nullable();
            $table->enum('nivel_ensino_experiencia_docente_titular', [
                'Educação Infantil',
                'Ensino fundamental - Anos Iniciais',
                'Ensino fundamental - Anos Finais',
                'Ensino Médio',
            ])->nullable();
            $table->boolean('experiencia_alunos_inclusao')->default(false);
            $table->text('casos_inclusao')->nullable();
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
