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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('ano_letivo');
            $table->string('serie');
            $table->enum('turno', ['MATUTINO', 'VESPERTINO', 'NOTURNO']);
            $table->integer('capacidade_maxima');
            $table->string('sala');
            $table->foreignId('professor_titular_id')->nullable()->constrained('funcionarios');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};