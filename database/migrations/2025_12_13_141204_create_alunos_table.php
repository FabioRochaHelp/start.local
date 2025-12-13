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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained()->onDelete('cascade');
            $table->string('matricula')->unique();
            $table->date('data_ingresso');
            $table->enum('turno', ['MATUTINO', 'VESPERTINO', 'NOTURNO']);
            $table->enum('situacao', ['ATIVO', 'TRANCADO', 'FORMADO', 'EVADIDO'])->default('ATIVO');
            $table->foreignId('responsavel_financeiro_id')->nullable()->constrained('pessoas');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};