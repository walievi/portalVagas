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
}
