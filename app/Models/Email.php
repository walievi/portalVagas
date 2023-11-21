<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    
    public $table = "emails";

   

    protected $fillable = [
        'email',
        'template',
        'conteudo',
    ];

    public function getEmailListAttribute()
    {
        return ($this->email != null) ? json_decode($this->email) : null;
    }
}
