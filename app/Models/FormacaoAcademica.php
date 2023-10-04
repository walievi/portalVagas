<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormacaoAcademica extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_medio',
        'ano_conclusao_medio',
        'curso_superior',
        'universidade_superior',
        'ano_conclusao_superior',
        'data_inicio_superior'
    ];
}
