<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function add(Request $request){
        $validated= $request->validate([
            "nome" => "required|max:255|unique:materials",
            "unidade_medida" => "required|max:255",
            "estoque_minimo" => "required|integer"
        ],[
            "nome.required" => "O nome do material é obrigatório!",
            "nome.unique" => "O material já existe!",
            "unidade_medida.required" => "A unidade de medida é obrigatória!",
            "estoque_minimo.required" => "É necessário definir uma quantidade mínima do estoque!"
        ]);

        Material::create([
            "nome" => $request->nome,
            "descricao" => $request->descricao,
            "unidade_medida" => $request->unidade_medida,
            "estoque_minimo" => $request->estoque_minimo,
            "localizacao" => $request->localizacao
        ]);

        return response()->json([
            "message" => "O material foi cadastrado com sucesso!"
        ],200);
    }
    public function list(Request $request){
        return Material::paginate(10);
    }
}
