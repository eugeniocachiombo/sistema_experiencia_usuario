<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ataque extends Model
{
    use HasFactory;

    protected $table = "ataque";
    protected $fillable = [
        "id",
        "nome_dispositivo",
        "navegador",
        "plataforma",
        "localizacao",
        "hora_ataque",
        "data_ataque",
        "descricao_ataque",
    ];
}
