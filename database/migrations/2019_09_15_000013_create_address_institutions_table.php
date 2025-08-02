<?php

use App\Models\Institution;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('address_institutions', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('street_name');
            $table->string('complement')->nullable();
            $table->integer('number');
            $table->string('neighborhood');
            $table->string('postalcode');
           
            $table->timestamps();

            $table->foreignIdFor(Institution::class)
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('address_institutions');
    }
};
