<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\meuResetDeSenha;


use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function respostas()
    {
        $this->hasMany(App\Models\Resposta::class);
    }

    public function dadosPessoais()
    {
        return $this->hasOne(DadosPessoais::class);
    }

    public function contato()
    {
        return $this->hasMany(Contato::class);
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function curriculo()
    {
        return $this->hasOne(Curriculo::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new meuResetDeSenha($token));
    }

    public function formacaoAcademica()
    {
        return $this->hasMany(FormacaoAcademica::class);
    }
}
