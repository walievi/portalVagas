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

    public function perguntas()
    {
        return null;
    }

    public function respostas()
    {
        $this->hasMany(Resposta::class, 'vaga_id')
    }
}
