<?php

namespace App\Models;
use App\Models\User;
use App\Models\Vaga;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'resposta',
        'curriculo_id',
        'user_id',
        'vaga_id',
        'pergunta_id',
        'candidatura_vaga_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }

    public function candidatura()
    {
        return $this->belongsTo(CandidaturaVaga::class, 'candidatura_vaga_id');
    }
}
