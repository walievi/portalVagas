<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cidade;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'uf'
    ];


    public function cidades()
    {
        return $this->hasMany(Cidade::class);
    }
    
}
