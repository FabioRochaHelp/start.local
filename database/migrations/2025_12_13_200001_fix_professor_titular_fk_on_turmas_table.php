<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('turmas', function (Blueprint $table) {
            // Drop FK antiga (funcionarios)
            $table->dropForeign(['professor_titular_id']);
        });

        Schema::table('turmas', function (Blueprint $table) {
            // Recria FK para pessoas
            $table->foreign('professor_titular_id')
                ->references('id')
                ->on('pessoas')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropForeign(['professor_titular_id']);
        });

        Schema::table('turmas', function (Blueprint $table) {
            $table->foreign('professor_titular_id')
                ->references('id')
                ->on('funcionarios');
        });
    }
};


