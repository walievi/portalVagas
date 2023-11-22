<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertEmailsTable extends Migration
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
                'id' => 1,
                'email' => '["guilhermedasilva@ienh.com.br","portalvagass@gmail.com"]',
                'template' => 'abertura_vaga',
                'conteudo' => '<h3>Prezado Departamento de Marketing da IENH,</h3>

                <p>Gostaríamos de informar que uma nova vaga foi aberta em nossa empresa, o processo de anúncio da vaga pode ser iniciado!</p>
            
                    <p><strong>Título da Vaga:</strong> {{ $titulo }}</p>
                    <p><strong>Local da Vaga (unidade):</strong> {{ $unidade }}</p>
            
            
                <p>Agradecemos antecipadamente pelo seu apoio e esforços na divulgação desta vaga.</p>
            
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
        DB :: table ('emails')->where('id', '=', 1)->delete();
    }
}
