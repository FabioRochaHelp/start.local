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
        Schema::create('contratos_financeiros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained();
            $table->foreignId('responsavel_financeiro_id')->constrained('pessoas');
            $table->foreignId('plano_pagamento_id')->constrained('planos_pagamento');
            $table->date('data_contrato');
            $table->decimal('valor_total_contrato', 10, 2);
            $table->decimal('desconto_aplicado', 5, 2)->default(0);
            $table->decimal('valor_final_contrato', 10, 2);
            $table->integer('dia_vencimento');
            $table->text('observacoes')->nullable();
            $table->enum('status', ['ATIVO', 'SUSPENSO', 'CANCELADO', 'CONCLUIDO'])->default('ATIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos_financeiros');
    }
};