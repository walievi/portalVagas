<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViewCandidaturaUsuarioFormacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW view_candidatura_usuario_formacao AS
                SELECT DISTINCT
                    cv.id as id,
                    u.id as user_id,
                    cv.vaga_id,
                    f.nivel_estudo_id,
                    cv.created_at
                FROM candidatura_vaga cv
                JOIN users u ON u.id = cv.user_id
                JOIN formacoes f ON u.id = f.user_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_candidatura_usuario_formacao");
    }
}
