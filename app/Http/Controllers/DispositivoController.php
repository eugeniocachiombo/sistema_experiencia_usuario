<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispositivo;
use Jenssegers\Agent\Agent;

class DispositivoController extends Controller
{
    public function registrarDispositivo($usuario)
    {
        $agent = new Agent();
        $dados_dispositivo = [
            "nome_dispositivo" => $agent->device(),
            "navegador" => $agent->browser(),
            "plataforma" => $agent->platform(),
            "localizacao" => "Não definido",
            "id_usuario" => $usuario->id,
        ];
        $dispositivo = Dispositivo::create($dados_dispositivo);
        return $dispositivo;
        //return response()->json($dispositivo);
    }
}
