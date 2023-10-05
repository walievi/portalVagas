<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 100);
            $table->string('uf', 2)->unique();
        });

        DB::table('estados')->insert(
            array(
                'id' => 1,
                'nome' => 'Acre',
                'uf' => 'AC'
            ),
            array(
                'id' => 2,
                'nome' => 'Alagoas',
                'uf' => 'AL'
            ),
            array(
                'id' => 3,
                'nome' => 'Amapá',
                'uf' => 'AP'
            ),
            array(
                'id' => 4,
                'nome' => 'Amazonas',
                'uf' => 'AM'
            ),
            array(
                'id' => 5,
                'nome' => 'Bahia',
                'uf' => 'BA'
            ),
            array(
                'id' => 6,
                'nome' => 'Ceará',
                'uf' => 'CE'
            ),
            array(
                'id' => 7,
                'nome' => 'Distrito Federal',
                'uf' => 'DF'
            ),
            array(
                'id' => 8,
                'nome' => 'Espírito Santo',
                'uf' => 'ES'
            ),
            array(
                'id' => 9,
                'nome' => 'Goiás',
                'uf' => 'GO'
            ),
            array(
                'id' => 10,
                'nome' => 'Maranhão',
                'uf' => 'MA'
            ),
            array(
                'id' => 11,
                'nome' => 'Mato Grosso',
                'uf' => 'MT'
            ),
            array(
                'id' => 12,
                'nome' => 'Mato Grosso do Sul',
                'uf' => 'MS'
            ),
            array(
                'id' => 13,
                'nome' => 'Minas Gerais',
                'uf' => 'MG'
            ),
            array(
                'id' => 14,
                'nome' => 'Pará',
                'uf' => 'PA'
            ),
            array(
                'id' => 15,
                'nome' => 'Paraíba',
                'uf' => 'PB'
            ),
            array(
                'id' => 16,
                'nome' => 'Paraná',
                'uf' => 'PR'
            ),
            array(
                'id' => 17,
                'nome' => 'Pernambuco',
                'uf' => 'PE'
            ),
            array(
                'id' => 18,
                'nome' => 'Piauí',
                'uf' => 'PI'
            ),
            array(
                'id' => 19,
                'nome' => 'Rio de Janeiro',
                'uf' => 'RJ'
            ),
            array(
                'id' => 20,
                'nome' => 'Rio Grande do Norte',
                'uf' => 'RN'
            ),
            array(
                'id' => 21,
                'nome' => 'Rio Grande do Sul',
                'uf' => 'RS'
            ),
            array(
                'id' => 22,
                'nome' => 'Rondônia',
                'uf' => 'RO'
            ),
            array(
                'id' => 23,
                'nome' => 'Roraima',
                'uf' => 'RR'
            ),
            array(
                'id' => 24,
                'nome' => 'Santa Catarina',
                'uf' => 'SC'
            ),
            array(
                'id' => 25,
                'nome' => 'São Paulo',
                'uf' => 'SP'
            ),
            array(
                'id' => 26,
                'nome' => 'Sergipe',
                'uf' => 'SE'
            ),
            array(
                'id' => 27,
                'nome' => 'Tocantins',
                'uf' => 'TO'
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
        Schema::dropIfExists('estados');
    }
}
