<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable= [
        "nome",
        "descricao",
        "quantidade",
        "unidade_medida",
        "estoque_minimo",
        "localizacao",
        "status"
    ];
}
