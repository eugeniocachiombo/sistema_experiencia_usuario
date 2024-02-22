<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AtaqueController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\UsuariosLogadosController;

Route::get('/usuario/cadastro', [UsuarioController::class, "cadastrarView"]);
Route::post('/usuario/cadastro', [UsuarioController::class, "cadastrarUsuario"]);



