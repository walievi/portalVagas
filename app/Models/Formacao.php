<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacao extends Model
{
    public $table = "formacao";

    use HasFactory;
    protected $fillable = [
        'local_medio',
        'ano_conclusao_medio',
        'curso_superior',
        'universidade_superior',
        'ano_conclusao_superior',
        'data_inicio_superior',
        'user_id'
    ];
}
