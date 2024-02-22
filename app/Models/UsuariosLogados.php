<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosLogados extends Model
{
    use HasFactory;

    protected $table = "usuarios_logados";
    protected $fillable = [
        "id_usuarios_logados",
        "id_usuario"
    ];
}
