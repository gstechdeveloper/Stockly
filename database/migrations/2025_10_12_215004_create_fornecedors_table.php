<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->string("nome")->primary();
            $table->string("endereco")->nullable();
            $table->string("cnpj")->nullable();
            $table->string("inscricao")->nullable();
            $table->string("tipofornecedor")->nullable();
            $table->string("telefone")->nullable();
            $table->string("situacao")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedors');
    }
};
