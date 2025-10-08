<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request){
        $validator= $request->validate([
            "name" => "string|required|min:8|max:30|unique:users",
            "email" => "string|required|min:8|max:50",
            "user_type" => "string|required",
            "password" => "string|required|min:8|max:50"
        ],[
            "name.required" => "Nome de usuário é obrigatório!",
            "name.unique" => "Nome de usuário já utilizado!",
            "name.max" => "Nome de usuário deve ter no máximo 30 caracteres!",
            "name.min" => "Nome de usuário deve ter no mínimo 8 caracteres!",
            "email.required" => "E-mail de usuário é obrigatório!",
            "email.max" => "E-mail de usuário deve ter no máximo 50 caracteres!",
            "email.min" => "E-mail de usuário deve ter no mínimo 8 caracteres!",
            "user_type.required" => "O tipo de usuário é obrigatório!",
            "password.required" => "Senha do usuário é obrigatória!",
            "password.max" => "Senha do usuário deve ter no máximo 50 caracteres!",
            "password.min" => "Senha do usuário deve ter no mínimo 8 caracteres!"
        ]);


        $user= User::create([
            "name" => $request->name,
            "email" => $request->email,
            "user_type" => $request->user_type,
            "password" => Hash::make($request->password)
        ]);

        return response()->json($user,201);
    }

    public function login(Request $request){
        $request->validate([
            "name" => "string|required",
            "password" => "string|required"
        ]);

        $user= User::where("name","=",$request->name)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(["error" => "Usuário ou senha inválidos!"],401);
        }

        $user->token= $user->createToken("toto")->plainTextToken;

        return response()->json($user,200);
    }
}