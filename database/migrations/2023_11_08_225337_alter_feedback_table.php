<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema :: table ('feedback', function (Blueprint $table) {
            $table->unsignedBigInteger('candidatura_vaga_id');
            $table->foreign('candidatura_vaga_id')
            ->references('id')
            ->on('candidatura_vaga')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
