<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertEmailTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table ('emails')->insert(
            array(
                'id' => 2,
                'email' => '',
                'template' => 'retorno_candidato',
                'conteudo' => '<h3>Prezado candidato,</h3>

                <p>Obrigado por participar do nosso processo seletivo para a vaga. Abaixo, você encontrará o feedback relacionado à sua candidatura:</p>
            
                <p><strong>Título da Vaga:</strong> {{ $titulo }}</p>
                <p><strong>Local da Vaga (Unidade):</strong> {{ $unidade }}</p>
            
                <h4>Feedback:</h4>
                <p>{{ $feedbackTexto }}</p>
            
                <p>Agradecemos pelo seu interesse em nossa instituição e participação no processo seletivo. Continue acompanhando nossas oportunidades.</p>
            
                <p>Atenciosamente,</p>
                <p>Núcleo Pedagógico IENH</p>',
            )
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB :: table ('emails')->where('id', '=', 2)->delete();

    }
}
