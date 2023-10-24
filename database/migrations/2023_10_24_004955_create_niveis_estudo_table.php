<?php

use App\Models\NivelEstudo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNiveisEstudoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveis_estudos', function (Blueprint $table) {
            $table->id();
            $table->string('nivel');
            $table->timestamps();
        });

        NivelEstudo::create([
            'nivel' => 'Ensino Fundamental',
        ]);

        NivelEstudo::create([
            'nivel' => 'Ensino Médio',
        ]);

        NivelEstudo::create([
            'nivel' => 'Técnico',
        ]);

        NivelEstudo::create([
            'nivel' => 'Superior',
        ]);

        NivelEstudo::create([
            'nivel' => 'Pós-Graduação',
        ]);

        NivelEstudo::create([
            'nivel' => 'Mestrado',
        ]);

        NivelEstudo::create([
            'nivel' => 'Doutorado',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveis_estudos');
    }
}
