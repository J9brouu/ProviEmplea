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
        Schema::create('talento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedTinyInteger('edad');
            $table->string('genero', 20);
            $table->string('telefono', 50);
            $table->string('direccion', 200);
            $table->text('resumen');
            $table->unsignedBigInteger('renta_desde');
            $table->unsignedBigInteger('renta_hasta');
            $table->string('condicion_jornada', 20);
            $table->string('condicion_modalidad', 20);
            $table->unsignedTinyInteger('discapacidad');
            $table->boolean('validacion');
        });

        Schema::create('antecedentes_educacionales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talento_id')->constrained('talento')->onDelete('cascade');
            $table->string('nombre_institucion');
            $table->date('ingreso');
            $table->date('egreso');
            $table->boolean('completo');
            $table->string('titulo', 100);
        });

        Schema::create('antecedentes_laborales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talento_id')->constrained('talento')->onDelete('cascade');
            $table->string('institucion_o_empresa', 100);
            $table->date('ingreso');
            $table->date('egreso');
            $table->string('cargo');
            $table->text('funciones');
            $table->string('referencia_nombre', 100);
            $table->string('referencia_telefono', 50);
            $table->string('referencia_correo', 255);
            $table->string('referencia_cargo', 255);
        });

        Schema::create('perfeccionamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talento_id')->constrained('talento')->onDelete('cascade');
            $table->string('tipo');
            $table->string('institucion');
            $table->string('nombre_curso');
            $table->date('ingreso');
            $table->date('egreso');
        });

        Schema::create('competencias_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talento_id')->constrained('talento')->onDelete('cascade');
            $table->string('nombre_competencia');
        });

        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('rut_empresa', 20);
            $table->string('rubro_empresa');
            $table->string('tipo_empresa');
            $table->text('presentacion_empresa');
            $table->text('beneficios_empresa');
            $table->boolean('validacion');
        });

        Schema::create('usuarios_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('empresa_asociada', 255);
            $table->string('telefono', 50);
        });

        Schema::create('interacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datos_empresa_id')->constrained('datos_empresa')->onDelete('cascade');
            $table->foreignId('talento_id')->constrained('talento')->onDelete('cascade');
            $table->unsignedTinyInteger('estado');
            $table->timestamps();
        });

        Schema::create('talento_archivo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talento_id')->constrained('talento')->onDelete('cascade');
            $table->string('tipo_archivo', 20);
            $table->text('url_archivo');
        });

        Schema::create('archivo_empresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datos_empresa_id')->constrained('datos_empresa')->onDelete('cascade');
            $table->string('tipo_archivo', 20);
            $table->text('url_archivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivo_empresa');
        Schema::dropIfExists('talento_archivo');
        Schema::dropIfExists('interacciones');
        Schema::dropIfExists('usuarios_empresa');
        Schema::dropIfExists('datos_empresa');
        Schema::dropIfExists('competencias_tecnicas');
        Schema::dropIfExists('perfeccionamiento');
        Schema::dropIfExists('antecedentes_laborales');
        Schema::dropIfExists('antecedentes_educacionales');
        Schema::dropIfExists('talento');
    }
};
