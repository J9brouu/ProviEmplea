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
            $table->bigInteger('edad');
            $table->string('genero', 20);
            $table->bigInteger('telefono');
            $table->string('direccion', 200);
            $table->string('resumen', 1000);
            $table->bigInteger('condicion_renta');
            $table->string('condicion_jornada', 20);
            $table->string('condicion_modalidad', 20);
            $table->bigInteger('discapacidad');
            $table->boolean('calidacion');
            $table->foreign('id')->references('id')->on('users');
        });

        Schema::create('antecedentes_educacionales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_institucion');
            $table->date('ingreso');
            $table->date('egreso');
            $table->boolean('completo');
            $table->string('titulo', 100);
            $table->foreign('id')->references('id')->on('talento');
        });

        Schema::create('antecedentes_laborales', function (Blueprint $table) {
            $table->id();
            $table->string('institucion_o_empresa', 100);
            $table->date('ingreso');
            $table->date('egreso');
            $table->string('cargo');
            $table->string('funciones', 1000);
            $table->string('referencia_nombre', 100);
            $table->bigInteger('referencia_telefono');
            $table->bigInteger('referencia_correo');
            $table->bigInteger('referencia_cargo');
            $table->foreign('id')->references('id')->on('talento');
        });

        Schema::create('perfeccionamiento', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('institucion');
            $table->bigInteger('nombre_curso');
            $table->date('ingreso');
            $table->date('egreso');
            $table->foreign('id')->references('id')->on('talento');
        });

        Schema::create('competencias_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_competencia');
            $table->foreign('id')->references('id')->on('talento');
        });

        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rut_empresa');
            $table->string('rubro_empresa');
            $table->string('tipo_empresa');
            $table->string('presentacion_empresa', 2000);
            $table->string('beneficios_empresa', 2000);
            $table->boolean('validacion');
            $table->foreign('id')->references('id')->on('users');
        });

        Schema::create('usuarios_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('empresa_asociada', 255);
            $table->bigInteger('telefono');
            $table->foreign('id')->references('id')->on('users');
        });

        Schema::create('interacciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_talento');
            $table->bigInteger('estado');
            $table->foreign('id')->references('id')->on('datos_empresa');
        });

        Schema::create('talento_archivo', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_archivo', 20);
            $table->bigInteger('url_archivo');
            $table->foreign('id')->references('id')->on('talento');
        });

        Schema::create('archivo_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_archivo', 20);
            $table->bigInteger('url_archivo');
            $table->foreign('id')->references('id')->on('datos_empresa');
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
