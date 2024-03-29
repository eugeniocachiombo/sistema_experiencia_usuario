<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AtaqueController;
use App\Http\Controllers\DispositivoController;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
        if (session("bloqueio_sistema") || session("tentativa_login") >= 2) {
            session()->put("bloqueio_sistema", true);
            return view("usuario.excessao_tentativas");
        } else if (session("id_usuario")) {
            return view("usuario.pagina_inicial");
        } else {
            return view("usuario.autenticacao");
        }
    }

    public function autenticarUsuario(Request $request)
    {
        return $this->validarAutenticacaoUsuario($request);
    }

    public function validarAutenticacaoUsuario(Request $request)
    {
        $usuario_email = $this->verificarEmailDigitado($request);
        $usuario_encontrado = $this->verificarExistenciaUsuario($usuario_email, $request);
        if ($usuario_encontrado) {
            return $this->verficarDispositivo($usuario_email);
        } else {
            return $this->criarSessaoContadoraTentativas($request); 
        }
    }

    public function verificarEmailDigitado(Request $request)
    {
        return Usuario::where("email_usuario", "=", $request->email_usuario)->first();
    }

    public function verificarExistenciaUsuario($usuario, Request $request)
    {
        $senha_usuario_email = $usuario->senha_usuario;
        $senha_digitada = $request->senha_usuario;
        $senha_verificada = Hash::check($senha_digitada, $senha_usuario_email);
        return $usuario && $senha_verificada;
    }

    public function verficarDispositivo($usuario)
    {
        $dispositvo = DispositivoController::buscarDispositivo($usuario);
        if ($dispositvo) {
            return $this->compararDadosBDPorDisposivoActual($usuario);
        } else {
            return $this->setarSessoesECookieIrPaginaInicial($usuario); 
        }
    }

    public function compararDadosBDPorDisposivoActual($usuario)
    {
        $agent = new Agent();
        $nome_dispositivo = $agent->device();
        $nome_navegador = $agent->browser();
        $nome_plataforma = $agent->platform();

        $dispositivo_actual = $nome_dispositivo;
        $navegador_actual = $nome_navegador . " " . $agent->version($nome_navegador);
        $plataforma_actual = $nome_plataforma . " " . $agent->version($nome_plataforma);
        $id_usuario_actual = $usuario->id;

        $dispositvo = DispositivoController::buscarDispositivo($usuario);
        $id_dispositivo_query = $dispositvo->id;
        $dispositivo_query = $dispositvo->nome_dispositivo;
        $navegador_query = $dispositvo->navegador;
        $plataforma_query = $dispositvo->plataforma;
        $id_usuario_query = $dispositvo->id_usuario;

        $se_dispositivo_igual = $dispositivo_actual == $dispositivo_query;
        $se_navegador_igual = $navegador_actual == $navegador_query;
        $se_plataforma_igual = $plataforma_actual == $plataforma_query;
        $se_usuario_igual = $id_usuario_actual == $id_usuario_query;

        if ($se_dispositivo_igual && $se_navegador_igual && $se_plataforma_igual && $se_usuario_igual) {

            session()->put("id_usuario", $usuario->id);
            session()->put("nome_usuario", $usuario->nome_usuario);
            session()->put("genero_usuario", $usuario->genero_usuario);
            session()->put("email_usuario", $usuario->email_usuario);

            session()->put("id_dispositivo_query", $id_dispositivo_query);
            session()->put("dispositivo_query", $dispositivo_query);
            session()->put("navegador_query", $navegador_query);
            session()->put("plataforma_query", $plataforma_query);

            setcookie("usuario_logado", "usuario_logado", 120);
            return view("usuario.pagina_inicial");
        } else {
            AtaqueController::registrarAtaque($usuario);
            Session::forget("usuario_logado");
            Session::forget("tentativa_login");
            Session::flush();
            return view("usuario.limite_sessoes");
        }
    }

    public function setarSessoesECookieIrPaginaInicial($usuario)
    {
        $agent = new Agent();
        $nome_dispositivo = $agent->device();
        $nome_navegador = $agent->browser();
        $nome_plataforma = $agent->platform();

        $dispositivo_actual = $nome_dispositivo;
        $navegador_actual = $nome_navegador . " " . $agent->version($nome_navegador);
        $plataforma_actual = $nome_plataforma . " " . $agent->version($nome_plataforma);

        DispositivoController::registrarDispositivo($usuario);
        $dispositvo = DispositivoController::buscarDispositivo($usuario);
        $id_dispositivo_query = $dispositvo->id;
        session()->put("id_dispositivo_query", $id_dispositivo_query);
        session()->put("dispositivo_query", $dispositivo_actual);
        session()->put("navegador_query", $navegador_actual);
        session()->put("plataforma_query", $plataforma_actual);

        session()->put("id_usuario", $usuario->id);
        session()->put("nome_usuario", $usuario->nome_usuario);
        session()->put("genero_usuario", $usuario->genero_usuario);
        session()->put("email_usuario", $usuario->email_usuario);

        setcookie("usuario_logado", "usuario_logado", 120);
        return view("usuario.pagina_inicial");
    }

    public function criarSessaoContadoraTentativas(Request $request)
    {
        $valor_sessao = session("tentativa_login");
        session()->put("tentativa_login", $valor_sessao + 1);
        setcookie("tentativa_login", 1, 60);
        $usuario = $this->verificarEmailDigitado($request);
        if ($usuario) {
            AtaqueController::registrarAtaque($usuario);
        }
        return redirect('/usuario/autenticacao')->with('notificacao', "Usuario não encontrado");
    }

    public function terminarSessao()
    {
        $id_dispositivo = session("id_dispositivo_query");
        DispositivoController::eliminarDispositivo($id_dispositivo);
        Session::forget("usuario_logado");
        Session::forget("tentativa_login");
        Session::flush();
        return redirect('/usuario/autenticacao');
    }
}
