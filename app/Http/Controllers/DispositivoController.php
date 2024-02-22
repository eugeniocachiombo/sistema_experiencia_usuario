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
        $dispositivo = $agent->device();
        $navegador = $agent->browser();
        $plataforma = $agent->platform();

        $dados_dispositivo = [
            "nome_dispositivo" => $dispositivo,
            "navegador" => $navegador . " " . $agent->version($navegador),
            "plataforma" => $plataforma . " " . $agent->version($plataforma),
            "localizacao" => "Não definido",
            "id_usuario" => $usuario->id,
        ];
        $dispositivo = Dispositivo::create($dados_dispositivo);
        return $dispositivo;
    }

    public function buscarDispositivo($usuario)
    {
        $dispositivo = Dispositivo::where("id_usuario", "=", $usuario->id)->first();
        return $dispositivo;
    }

    public function eliminarDispositivo($id_dispositivo)
    {
        $dispositivo = Dispositivo::find($id_dispositivo);
        return $dispositivo->delete();
    }
}
