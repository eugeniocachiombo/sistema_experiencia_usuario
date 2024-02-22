<?php

namespace App\Http\Controllers;
use App\Models\Ataque;

class AtaqueController extends Controller
{
    public function registrarAtaque()
    {
        $dados_ataque = [
            "nome_dispositivo" => "nome_dispositivo",
            "navegador" => "navegador",
            "plataforma" => "plataforma",
            "localizacao" => "localizacao",
            "id_usuario" => 1,
        ];
        $ataque = Ataque::create($dados_ataque);
        return response()->json($ataque);
    }
}
