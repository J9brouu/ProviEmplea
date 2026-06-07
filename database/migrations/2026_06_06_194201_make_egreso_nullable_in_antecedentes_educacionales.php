<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // egreso puede ser null cuando el usuario está "en curso" o "actualmente estudio aquí"
        Schema::table('antecedentes_educacionales', function (Blueprint $table) {
            $table->date('egreso')->nullable()->change();
        });

        Schema::table('antecedentes_laborales', function (Blueprint $table) {
            $table->date('egreso')->nullable()->change();
            $table->text('funciones')->nullable()->change();
            $table->string('referencia_nombre', 100)->nullable()->change();
            $table->string('referencia_telefono', 50)->nullable()->change();
            $table->string('referencia_correo', 255)->nullable()->change();
            $table->string('referencia_cargo', 255)->nullable()->change();
        });

        Schema::table('perfeccionamiento', function (Blueprint $table) {
            $table->date('egreso')->nullable()->change();
        });

        // Campos del talento que se completan después del registro
        Schema::table('talento', function (Blueprint $table) {
            $table->unsignedTinyInteger('edad')->nullable()->change();
            $table->string('genero', 20)->nullable()->change();
            $table->string('telefono', 50)->nullable()->change();
            $table->string('direccion', 200)->nullable()->change();
            $table->text('resumen')->nullable()->change();
            $table->unsignedBigInteger('renta_desde')->default(0)->change();
            $table->unsignedBigInteger('renta_hasta')->default(0)->change();
            $table->string('condicion_jornada', 20)->nullable()->change();
            $table->string('condicion_modalidad', 20)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('antecedentes_educacionales', function (Blueprint $table) {
            $table->date('egreso')->nullable(false)->change();
        });

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

        Schema::table('talento', function (Blueprint $table) {
            $table->unsignedTinyInteger('edad')->nullable(false)->change();
            $table->string('genero', 20)->nullable(false)->change();
            $table->string('telefono', 50)->nullable(false)->change();
            $table->string('direccion', 200)->nullable(false)->change();
            $table->text('resumen')->nullable(false)->change();
            $table->unsignedBigInteger('renta_desde')->default(null)->change();
            $table->unsignedBigInteger('renta_hasta')->default(null)->change();
            $table->string('condicion_jornada', 20)->nullable(false)->change();
            $table->string('condicion_modalidad', 20)->nullable(false)->change();
        });
    }
};
