<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Formacao extends Model
{
    use HasFactory;

    public $table = "formacoes";

    protected $fillable = [
        'user_id',
        'nivel_estudo_id',
        'curso',
        'instituicao',
        'data_inicio',
        'data_fim',
        'observacao'
    ];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('current_user', function (Builder $builder) {
            $builder->where('user_id', Auth::user()->id);
        });

        static::saving(function ($model) {
            $model->user_id = Auth::user()->id;
        });
    }

    public function nivelEstudo(): BelongsTo
    {
        return $this->belongsTo(NivelEstudo::class, 'nivel_estudo_id', 'id');
    }


}
