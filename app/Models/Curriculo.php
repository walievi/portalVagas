<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Curriculo extends Model
{
    use HasFactory;

    public $table = "curriculos";

   

    protected $fillable = [
        'pdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
