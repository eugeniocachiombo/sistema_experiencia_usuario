<?php

namespace App\Http\Controllers;

use App\Models\Ataque;
use Jenssegers\Agent\Agent;

class AtaqueController extends Controller
{
    public function registrarAtaque($usuario)
    {
        $agent = new Agent();
        $dados_ataque = [
            "nome_dispositivo" => $agent->device(),
            "navegador" => $agent->browser(),
            "plataforma" => $agent->platform(),
            "localizacao" => "Não definido",
            "id_usuario" => $usuario->id,
        ];
        $ataque = Ataque::create($dados_ataque);
        return $ataque;
        //return response()->json($ataque);
    }
}
