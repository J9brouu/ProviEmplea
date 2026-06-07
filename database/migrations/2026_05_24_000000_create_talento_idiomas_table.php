<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talento_idiomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talento_id')->constrained('talento')->onDelete('cascade');
            $table->string('nombre_idioma', 100);
            $table->string('nivel', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talento_idiomas');
    }
};
