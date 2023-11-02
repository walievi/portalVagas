<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculosVaga extends Model
{
    use HasFactory;

    public $table = "respostas";


    /**
 * The attributes that are mass assignable.
 *
 * @var array<int, string>
 */
protected $fillable = [
    'user_id',
    'vaga_id'
];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');


}

public function vaga()
{
    return $this->belongsTo(Vaga::class, 'vaga_id');

}
}