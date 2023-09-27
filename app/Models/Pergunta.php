<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;



    protected $fillable = [
        'pergunta',
        'options',
        'mult_resps'
    ];



    public function vagas()
    {
        return $this->belongsToMany(Vaga::class, 'pergunta_vaga')
        ->using(PerguntaVaga::class) // Use a model de pivot personalizada
        ->withPivot('required'); // Outras colunas pivot, se necessário
    }

    public function respostas()
    {
        return $this->hasMany(Resposta::class, 'pergunta_id');
    }


    public function getFreeTextAttribute()
    {
        return $this->options == null;
    }

    public function getOptionsListAttribute()
    {
        return ($this->options != null) ? json_decode($this->options) : null;
    }
}
