<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;


class FornecedorController extends Controller
{
    public function add(Request $request){
        $validated= $request->validate([
            "nome" => "string|required|unique:fornecedors"
        ],[
            "nome.required" => "O nome do fornecedor é obrigatório!",
            "nome.unique" => "O nome de fornecedor já existe!"
        ]);

        Fornecedor::create($request->all());

        return response()->json([
            "message" => "O fornecedor foi cadastrado com sucesso!"
        ],200);
    }

    public function list(Request $request){
        return Fornecedor::paginate(10);
    }

    public function select(Request $request){
        return Fornecedor::where("nome","=",$request->nome)->get();
    }

    public function update(Request $request){
        $validated= $request->validate([
            "updatedNome" => "string|required|unique:fornecedors,nome"

        ], [
            "updatedNome.required" => "O nome do fornecedor é obrigatório!",
            "updatedNome.unique" => "Nome do fornecedor já existe!"
        ]);

        $fornecedor= Fornecedor::where("nome","=",$request->currentNome);

        $updated= $fornecedor->update([
            "nome" => $request->updatedNome,
            "endereco" => $request->endereco,
            "cnpj" => $request->cnpj,
            "inscricao" => $request->inscricao,
            "tipofornecedor" => $request->tipofornecedor,
            "telefone" => $request->telefone,
            "situacao" => $request->situacao
        ]);

        return response()->json([
            "message" => "Fornecedor atualizado com sucesso!"
        ],200);
    }
}
