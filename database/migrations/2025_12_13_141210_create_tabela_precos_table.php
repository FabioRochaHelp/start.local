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
        Schema::create('tabela_precos', function (Blueprint $table) {
            $table->id();
            $table->integer('ano_letivo');
            $table->string('serie');
            $table->enum('turno', ['MATUTINO', 'VESPERTINO', 'NOTURNO']);
            $table->decimal('valor_mensalidade', 10, 2);
            $table->decimal('valor_matricula', 10, 2);
            $table->decimal('valor_material', 10, 2)->default(0);
            $table->decimal('valor_atividades_extras', 10, 2)->default(0);
            $table->decimal('valor_transporte', 10, 2)->nullable();
            $table->date('vigencia_inicio');
            $table->date('vigencia_fim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabela_precos');
    }
};