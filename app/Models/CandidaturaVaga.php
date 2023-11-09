<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidaturaVaga extends Model
{
    use HasFactory;

    protected $table = 'candidatura_vaga';

    protected $fillable = [
        'user_id',
        'vaga_id'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vaga(){
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }

    public function feedback(){
        return $this->hasOne(Feedback::class, 'candidatura_vaga_id');
    }

    public function getRespostas() {
        if ($this->transferencia_vaga !== null) {
            // O candidato foi transferido, portanto, usamos a vaga original (transferencia_vaga) para buscar as respostas
            return Resposta::where('user_id', $this->user_id)->where('vaga_id', $this->transferencia_vaga)->get();
        } else {
            // O candidato não foi transferido, usamos a vaga atual (vaga_id) para buscar as respostas
            return Resposta::where('user_id', $this->user_id)->where('vaga_id', $this->vaga_id)->get();
        }
    }
    
}
