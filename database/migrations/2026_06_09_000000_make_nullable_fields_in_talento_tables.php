<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // antecedentes_laborales: egreso y campos de referencia son opcionales
        Schema::table('antecedentes_laborales', function (Blueprint $table) {
            $table->date('egreso')->nullable()->change();
            $table->text('funciones')->nullable()->change();
            $table->string('referencia_nombre', 100)->nullable()->change();
            $table->string('referencia_telefono', 50)->nullable()->change();
            $table->string('referencia_correo', 255)->nullable()->change();
            $table->string('referencia_cargo', 255)->nullable()->change();
        });

        // perfeccionamiento: egreso es opcional (cursos en curso)
        Schema::table('perfeccionamiento', function (Blueprint $table) {
            $table->date('egreso')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('antecedentes_laborales', function (Blueprint $table) {
            $table->date('egreso')->nullable(false)->change();
            $table->text('funciones')->nullable(false)->change();
            $table->string('referencia_nombre', 100)->nullable(false)->change();
            $table->string('referencia_telefono', 50)->nullable(false)->change();
            $table->string('referencia_correo', 255)->nullable(false)->change();
            $table->string('referencia_cargo', 255)->nullable(false)->change();
        });

        Schema::table('perfeccionamiento', function (Blueprint $table) {
            $table->date('egreso')->nullable(false)->change();
        });
    }
};
