<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historico_movimentacoes', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('ativo_id')->constrained('ativos')->onDelete('restrict');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict'); // Quem gerou a ação
            
            // Tipo de movimentação limitado aos tipos do escopo
            $table->string('tipo', 30); // Cadastro, Alteração, Empréstimo, Devolução, Manutenção, Baixa
            $table->text('descricao'); // Detalhes do que mudou
            
            $table->timestamp('created_at')->useCurrent(); // Histórico foca no momento da inserção
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historico_movimentacoes');
    }
};