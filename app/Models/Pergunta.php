<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    public function vagas()
    {
        return null;
    }

    public function respostas()
    {
        $this->hasMany(Resposta::class, 'pergunta_id')
    }
}
