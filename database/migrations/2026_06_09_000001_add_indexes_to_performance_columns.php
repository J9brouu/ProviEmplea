<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('rol');
            $table->index('estado');
        });

        Schema::table('interacciones', function (Blueprint $table) {
            $table->index('estado');
        });

        Schema::table('talento', function (Blueprint $table) {
            $table->index('condicion_jornada');
            $table->index('condicion_modalidad');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['rol']);
            $table->dropIndex(['estado']);
        });

        Schema::table('interacciones', function (Blueprint $table) {
            $table->dropIndex(['estado']);
        });

        Schema::table('talento', function (Blueprint $table) {
            $table->dropIndex(['condicion_jornada']);
            $table->dropIndex(['condicion_modalidad']);
        });
    }
};
