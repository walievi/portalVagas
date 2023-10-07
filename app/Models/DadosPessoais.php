<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosPessoais extends Model
{
    use HasFactory;


    protected $fillable = [
        'data_nascimento',
        'endereco_id',
        'formacao_id',
        'contato_id',
        'user_id',
        'objetivo_vaga',
        'habilidades',
    ];

    public function contato()
    {
        return $this->belongsTo(Contato::class, 'contato_id');
    }
    

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }
    
}
