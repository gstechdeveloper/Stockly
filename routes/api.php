<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MaterialController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::post("/fornecedor/add",[FornecedorController::class,"add"]);
Route::get("/fornecedor/list",[FornecedorController::class,"list"]);
Route::post("/fornecedor/select",[FornecedorController::class,"select"]);
Route::put("/fornecedor/update",[FornecedorController::class,"update"]);
Route::post("/material/add",[MaterialController::class,"add"]);
Route::get("/material/list",[MaterialController::class,"list"]);