<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get("/", [UserController::class, "Index"]);
Route::get('/teste/{name}&{age}', [UserController::class, "MyProfile"])
->where("name", "[A-Za-z]*")
->where("age", "[0-9]*");
Route::get("/teste/name/{name}", [UserController::class, "MyName"])
->where("name", "[A-Za-z]*");
Route::get("/teste/age/{age}", [UserController::class, "MyAge"])
->where("age", "[0-9]*");


