<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Dispositivo;
use App\Http\Controllers\AtaqueController;
use App\Http\Controllers\DispositivoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

class UsuarioController extends Controller
{
    public function cadastrarView()
    {
        return view("usuario.cadastro");
    }

    public function cadastrarUsuario(Request $request)
    {
        $usuario = [
            "nome_usuario" => $request->nome_usuario,
            "genero_usuario" => $request->genero_usuario,
            "email_usuario" => $request->email_usuario,
            "senha_usuario" => Hash::make($request->senha_usuario),
        ];
        $resultado = Usuario::create($usuario);
        return redirect('/usuario/cadastro')->with('notificacao', "Cadastrado com sucesso");
    }

    public function autenticarView(Request $request)
    {
        return view("usuario.autenticacao");
    }

    public function autenticarUsuario(Request $request)
    {
        if (session("tentativa_login") != 1) {
            return $this->validarAutenticacaoUsuario($request);
        } else {
            return view("usuario.excessao_tentativas");
        }
    }

    public function validarAutenticacaoUsuario(Request $request)
    {
        $usuario = $this->verificarEmailUsuario($request);
        $usuario_encontrado = $this->verificarExistenciaUsuario($usuario, $request);
        if ($usuario_encontrado) {
            return $this->verficarDispositivo($usuario);
        } else {
            return $this->criarSessaoContadoraTentativas($request);
        }
    }

    public function verficarDispositivo($usuario)
    {
        $dispositvo = DispositivoController::buscarDispositivo($usuario);
        
        if ($dispositvo) {
            $agent = new Agent();
            $nome_dispositivo = $agent->device();
            $nome_navegador = $agent->browser();
            $nome_plataforma = $agent->platform();

            $dispositivo_actual = $nome_dispositivo;
            $navegador_actual = $nome_navegador . " " . $agent->version($nome_navegador);
            $plataforma_actual = $nome_plataforma . " " . $agent->version($nome_plataforma);
            $id_usuario_actual = $usuario->id;

            $dispositvo = DispositivoController::buscarDispositivo($usuario);
            $dispositivo_query = $dispositvo->nome_dispositivo;
            $navegador_query = $dispositvo->navegador;
            $plataforma_query = $dispositvo->plataforma;
            $id_usuario_query = $dispositvo->id_usuario;

            if(
            $dispositivo_actual == $dispositivo_query 
            && $navegador_actual == $navegador_query 
            && $plataforma_actual == $plataforma_query
            && $id_usuario_actual == $id_usuario_query){
                session()->put("nome_usuario",  $usuario->nome_usuario);
                session()->put("genero_usuario", $usuario->genero_usuario);
                session()->put("email_usuario", $usuario->email_usuario);
                session()->put("dispositivo_query", $dispositivo_query);
                session()->put("navegador_query",   $navegador_query);
                session()->put("plataforma_query", $plataforma_query);
                return view("usuario.pagina_inicial");
            }else{
                AtaqueController::registrarAtaque($usuario);
                return view("usuario.limite_sessoes");
            }
            
        } else {
            DispositivoController::registrarDispositivo($usuario);
            session()->put("nome_usuario", $usuario->nome_usuario);
            session()->put("genero_usuario",$usuario->genero_usuario);
            session()->put("email_usuario",$usuario->email_usuario);
            return view("usuario.pagina_inicial");
        }
    }

    public function verificarEmailUsuario(Request $request)
    {
        return Usuario::where("email_usuario", "=", $request->email_usuario)->first();
    }

    public function verificarExistenciaUsuario($usuario, Request $request)
    {
        return $usuario && Hash::check($request->senha_usuario, $usuario->senha_usuario);
    }

    public function criarSessaoContadoraTentativas(Request $request)
    {
        $valor_sessao = session("tentativa_login");
        session()->put("tentativa_login", $valor_sessao + 1);
        setcookie("tentativa_login", 1, 60);
        $usuario = $this->verificarEmailUsuario($request);
        if ($usuario) {
            AtaqueController::registrarAtaque($usuario);
        }
        return redirect('/usuario/autenticacao')->with('notificacao', "Usuario não encontrado");
    }
}
