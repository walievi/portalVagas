<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $estados = [
            ['id' => 1, 'nome' => 'Acre', 'uf' => 'AC'],
            ['id' => 2, 'nome' => 'Alagoas', 'uf' => 'AL'],
            ['id' => 3, 'nome' => 'Amapá', 'uf' => 'AP'],
            ['id' => 4, 'nome' => 'Amazonas', 'uf' => 'AM'],
            ['id' => 5, 'nome' => 'Bahia', 'uf' => 'BA'],
            ['id' => 6, 'nome' => 'Ceará', 'uf' => 'CE'],
            ['id' => 7, 'nome' => 'Distrito Federal', 'uf' => 'DF'],
            ['id' => 8, 'nome' => 'Espírito Santo', 'uf' => 'ES'],
            ['id' => 9, 'nome' => 'Goiás', 'uf' => 'GO'],
            ['id' => 10, 'nome' => 'Maranhão', 'uf' => 'MA'],
            ['id' => 11, 'nome' => 'Mato Grosso', 'uf' => 'MT'],
            ['id' => 12, 'nome' => 'Mato Grosso do Sul', 'uf' => 'MS'],
            ['id' => 13, 'nome' => 'Minas Gerais', 'uf' => 'MG'],
            ['id' => 14, 'nome' => 'Pará', 'uf' => 'PA'],
            ['id' => 15, 'nome' => 'Paraíba', 'uf' => 'PB'],
            ['id' => 16, 'nome' => 'Paraná', 'uf' => 'PR'],
            ['id' => 17, 'nome' => 'Pernambuco', 'uf' => 'PE'],
            ['id' => 18, 'nome' => 'Piauí', 'uf' => 'PI'],
            ['id' => 19, 'nome' => 'Rio de Janeiro', 'uf' => 'RJ'],
            ['id' => 20, 'nome' => 'Rio Grande do Norte', 'uf' => 'RN'],
            ['id' => 21, 'nome' => 'Rio Grande do Sul', 'uf' => 'RS'],
            ['id' => 22, 'nome' => 'Rondônia', 'uf' => 'RO'],
            ['id' => 23, 'nome' => 'Roraima', 'uf' => 'RR'],
            ['id' => 24, 'nome' => 'Santa Catarina', 'uf' => 'SC'],
            ['id' => 25, 'nome' => 'São Paulo', 'uf' => 'SP'],
            ['id' => 26, 'nome' => 'Sergipe', 'uf' => 'SE'],
            ['id' => 27, 'nome' => 'Tocantins', 'uf' => 'TO']
        ];
    
        foreach ($estados as $estado) {
            DB::table('estados')->insert($estado);
        }


           
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('estados')->delete();
    }
}
