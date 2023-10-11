<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Edit2DadosPessoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_pessoais', function (Blueprint $table) {
        
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->date('data_nascimento')->nullable()->change();
            $table->text('habilidades')->nullable()->change();
            
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
