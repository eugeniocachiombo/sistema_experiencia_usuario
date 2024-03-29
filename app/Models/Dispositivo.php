<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $table = "dispositivo";
    protected $fillable = [
        "id",
        "nome_dispositivo",
        "navegador",
        "plataforma",
        "localizacao",
        "id_usuario"
    ];
}
