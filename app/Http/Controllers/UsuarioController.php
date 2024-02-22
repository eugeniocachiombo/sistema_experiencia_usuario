<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function cadastrarView(){
       return view("usuario.cadastro");
    }

    public function cadastrarUsuario(Request $request){
        $usuario = [
        "nome_usuario" => $request->nome_usuario,
        "genero_usuario" => $request->genero_usuario,
        "email_usuario" => $request->email_usuario,
        "senha_usuario" => bcrypt($request->senha_usuario)
        ];
        $resultado = Usuario::create($usuario);
        return redirect('/usuario/cadastro')->with('success', "Cadastrado com sucesso");
    }
}
