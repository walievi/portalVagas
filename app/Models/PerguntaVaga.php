<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PerguntaVaga extends Pivot
{
    use HasFactory;

    protected $table = 'pergunta_vaga';

    protected $fillable = [
        'pergunta_id',
        'vaga_id',
        'required',
    ];

    public $timestamps = false;

    public function pergunta(){
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function vaga(){
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }


}
