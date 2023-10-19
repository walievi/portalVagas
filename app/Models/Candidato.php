<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;



class Candidato extends Model
{
    use HasFactory;

    public $table = 'dados_pessoais';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function contato()
    {
        return $this->hasOne(Contato::class, 'id', 'contato_id');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'contato_id');
    }

    public static function logged()
    {
        return self::where('user_id', Auth::user()->id)->first();
    }
}
