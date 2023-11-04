<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelEstudo extends Model
{
    use HasFactory;

    public $table = 'niveis_estudos';
    public $fillable = [
        'nivel'
    ];
}
