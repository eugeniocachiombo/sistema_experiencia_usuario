<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AtaqueController;
use App\Http\Controllers\DispositivoController;

Route::get('/', [UsuarioController::class, "autenticarView"]);
Route::get('/usuario/cadastro', [UsuarioController::class, "cadastrarView"]);
Route::post('/usuario/cadastro', [UsuarioController::class, "cadastrarUsuario"]);
Route::get('/usuario/autenticacao', [UsuarioController::class, "autenticarView"]);
Route::post('/usuario/autenticacao', [UsuarioController::class, "autenticarUsuario"]);



