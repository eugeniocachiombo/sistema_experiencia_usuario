<?php

namespace App\Http\Controllers;

use App\Models\Ataque;
use Jenssegers\Agent\Agent;

class AtaqueController extends Controller
{
    public function registrarAtaque($usuario)
    {
        $agent = new Agent();
        $dispositivo = $agent->device();
        $navegador = $agent->browser();
        $plataforma = $agent->platform();

        $dados_ataque = [
            "nome_dispositivo" => $dispositivo,
            "navegador" => $navegador . " " . $agent->version($navegador),
            "plataforma" => $plataforma . " " . $agent->version($plataforma),
            "localizacao" => "Não definido",
            "id_usuario" => $usuario->id,
        ];
        $ataque = Ataque::create($dados_ataque);
        return $ataque;
    }

    public function buscarAtaque($usuario)
    {
        $ataque = Ataque::where("id_usuario", "=", $usuario->id)->count();
        return $ataque;
    }

    public function ataqueView()
    {   
        $ataques = Ataque::where("id_usuario", "=", session("id_usuario"))->get();
        return view("usuario.ataques", compact("ataques"));
    }
}
