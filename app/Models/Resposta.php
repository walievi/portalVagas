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
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFreeTextAttribute()
    {
        return $this->resposta == null;
    }

    public function getRespostaListAttribute()
    {
        return ($this->resposta != null) ? json_decode($this->resposta) : null;
    }
}
