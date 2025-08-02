<?php

use App\Models\Role;
use App\Models\Institution;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->boolean('status')->default(true);
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->char('gender')->default('F');
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('cpf')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('user_type_id')->constrained('user_types')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
