<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;

    protected $table = 'respostas';

    protected $fillable = [
        'pergunta_id',
        'vaga_id',
        'user_id',
        'resposta',
    ];

    public function pergunta()
    {
        $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function vaga()
    {
        $this->belongsTo(Vaga::class, 'vaga_id');
    }

    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
