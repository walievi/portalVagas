<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    public $table = "vagas";


        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'unidade',
        'status'
    ];

    public function candidaturas()
    {
        return $this->hasMany(CandidaturaVaga::class, 'vaga_id');
    }

    public function respostas()
    {
        return $this->hasMany(Resposta::class, 'vaga_id');
    }

    public function perguntas()
    {
        return $this->belongsToMany(Pergunta::class, 'respostas', 'vaga_id', 'pergunta_id');
    }
}
