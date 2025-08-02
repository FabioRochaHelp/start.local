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
        Schema::create('sub_menu_users_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_menu_id')->constrained('sub_menus')->onDelete('cascade');
            $table->foreignId('user_type_id')->constrained('user_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_menu_users_types');
    }
};
