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
        Schema::create('fluxo_caixa', function (Blueprint $table) {
            $table->id();
            $table->date('data_movimento');
            $table->enum('tipo', ['ENTRADA', 'SAIDA']);
            $table->decimal('valor', 10, 2);
            $table->enum('forma_pagamento', ['BOLETO', 'PIX', 'CARTAO', 'DINHEIRO', 'TRANSFERENCIA']);
            $table->string('descricao');
            $table->foreignId('parcela_id')->nullable()->constrained();
            $table->foreignId('despesa_id')->nullable()->constrained();
            $table->decimal('saldo_dia', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fluxo_caixa');
    }
};