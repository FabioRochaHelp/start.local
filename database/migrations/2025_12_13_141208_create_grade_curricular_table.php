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
        Schema::create('grade_curricular', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turma_id')->constrained();
            $table->foreignId('disciplina_id')->constrained();
            $table->foreignId('professor_id')->constrained('funcionarios');
            $table->json('horario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_curricular');
    }
};