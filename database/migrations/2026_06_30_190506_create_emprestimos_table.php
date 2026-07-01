<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            
            // Chaves Estrangeiras
            $table->foreignId('ativo_id')->constrained('ativos')->onDelete('restrict');
            $table->foreignId('colaborador_id')->constrained('colaboradores')->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict'); // Técnico/Admin que realizou
            
            // Datas e Controle
            $table->dateTime('data_emprestimo');
            $table->date('previsao_devolucao')->nullable();
            $table->dateTime('data_devolucao')->nullable(); // Nulo enquanto estiver emprestado
            $table->text('observacoes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprestimos');
    }
};