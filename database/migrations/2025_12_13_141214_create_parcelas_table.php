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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->constrained('contratos_financeiros');
            $table->string('numero_parcela');
            $table->string('descricao');
            $table->decimal('valor_original', 10, 2);
            $table->decimal('valor_com_desconto', 10, 2);
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->decimal('valor_pago', 10, 2)->nullable();
            $table->enum('forma_pagamento', ['BOLETO', 'PIX', 'CARTAO', 'DINHEIRO', 'TRANSFERENCIA'])->nullable();
            $table->enum('status', ['ABERTA', 'PAGA', 'ATRASADA', 'CANCELADA'])->default('ABERTA');
            $table->decimal('juros_aplicados', 10, 2)->default(0);
            $table->decimal('multa_aplicada', 10, 2)->default(0);
            $table->decimal('desconto_concedido', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelas');
    }
};