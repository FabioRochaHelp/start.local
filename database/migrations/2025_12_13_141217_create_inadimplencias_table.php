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
        Schema::create('inadimplencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained();
            $table->foreignId('parcela_id')->nullable()->constrained();
            $table->integer('dias_atraso');
            $table->decimal('valor_devido', 10, 2);
            $table->date('data_primeiro_atraso');
            $table->enum('status', ['EM_NEGOCIACAO', 'JUDICIAL', 'PROTESTADO']);
            $table->json('acoes_tomadas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inadimplencias');
    }
};