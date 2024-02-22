<?php

namespace App\Http\Controllers;

use App\Models\Ataque;
use Jenssegers\Agent\Agent;

class AtaqueController extends Controller
{
    public function registrarAtaque()
    {
        $agent = new Agent();
        $dados_ataque = [
            "nome_dispositivo" => $agent->device(),
            "navegador" => $agent->browser(),
            "plataforma" => $agent->platform(),
            "localizacao" => "Não definido",
            "id_usuario" => 1,
        ];
        $ataque = Ataque::create($dados_ataque);
        return response()->json($ataque);
    }
}
