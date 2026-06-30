<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ativos', function (Blueprint $table) {
            $table->id();
            
            // Chaves Estrangeiras (Foreign Keys)
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('restrict');
            $table->foreignId('status_ativo_id')->constrained('status_ativos')->onDelete('restrict');
            
            
            $table->string('patrimonio', 50)->unique(); // Código de patrimônio único da empresa
            $table->string('nome', 150);
            $table->string('marca', 100);
            $table->string('modelo', 100);
            $table->string('numero_serie', 100)->nullable();
            $table->date('data_aquisicao')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->string('localizacao', 150)->nullable(); // Ex: Almoxarifado, Prédio A, etc.
            $table->text('observacoes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ativos');
    }
};