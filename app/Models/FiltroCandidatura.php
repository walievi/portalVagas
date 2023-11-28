<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PhpParser\Node\Expr\Throw_;

class FiltroCandidatura extends Model
{
    use HasFactory;

    public $table = 'view_candidatura_usuario_formacao';
    protected static function booted(): void
    {
        static::creating(function () {
            Throw new \Exception("Não pode insert");
        });

        static::updating(function () {
            Throw new \Exception("Não pode update");
        });

        static::deleting(function () {
            Throw new \Exception("Não pode delete");
        });
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'candidatura_vaga_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function vaga()
    {
        return $this->hasOne(Vaga::class, 'id', 'vaga_id');
    }

    public function nivel_estudo(): HasOne
    {
        return $this->hasOne(NivelEstudo::class, 'id', 'nivel_estudo_id');
    }
}
