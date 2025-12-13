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
        Schema::create('bolsas_descontos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained();
            $table->enum('tipo', ['BOLSISTA', 'DESCONTO_FAMILIA', 'DESCONTO_PROMOCIONAL']);
            $table->decimal('percentual', 5, 2)->nullable();
            $table->decimal('valor_fixo', 10, 2)->nullable();
            $table->date('data_inicio');
            $table->date('data_termino')->nullable();
            $table->string('motivo');
            $table->json('documentos_anexos')->nullable();
            $table->enum('status', ['ATIVO', 'EXPIRADO', 'CANCELADO'])->default('ATIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bolsas_descontos');
    }
};