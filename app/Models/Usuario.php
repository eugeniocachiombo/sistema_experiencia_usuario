<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuario";
    protected $fillable = [
        "id",
        "nome_usuario",
        "genero_usuario",
        "email_usuario",
        "senha_usuario"
    ];
}
