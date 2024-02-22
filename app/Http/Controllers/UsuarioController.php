<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            $usuario = $this->verificarEmailUsuario();
            $existencia_usuario = $this->verificarExistenciaUsuario($usuario); 
            if ($existencia_usuario) {
                return view("usuario.pagina_inicial");
            } else {
                $this->criarSessaoContadoraTentativas();
                return redirect('/usuario/autenticacao')->with('notificacao', "Usuario não encontrado");
            }
        } else {
            return view("usuario.excessao_tentativas");
        }
    }

    public function verificarEmailUsuario(){
        return Usuario::where("email_usuario", "=", $request->email_usuario)->first();
    }

    public function verificarExistenciaUsuario($usuario){
        return $usuario && Hash::check($request->senha_usuario, $usuario->senha_usuario);
    }

    public function criarSessaoContadoraTentativas(){
        $valor_sessao = session("tentativa_login");
        session()->put("tentativa_login", $valor_sessao + 1);
        setcookie("tentativa_login", 1, 60);
    }
}
