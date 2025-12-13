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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained()->onDelete('cascade');
            $table->string('matricula_funcional')->unique();
            $table->enum('cargo', ['PROFESSOR', 'COORDENADOR', 'DIRETOR', 'SECRETARIO', 'AUXILIAR']);
            $table->string('formacao')->nullable();
            $table->date('data_admissao');
            $table->decimal('salario_base', 10, 2);
            $table->integer('carga_horaria_semanal');
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('conta_corrente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};