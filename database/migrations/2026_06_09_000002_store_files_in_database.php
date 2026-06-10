<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // talento_archivo: contenido binario + mime
        Schema::table('talento_archivo', function (Blueprint $table) {
            $table->longText('contenido')->nullable()->after('url_archivo');
            $table->string('mime_type', 100)->nullable()->after('contenido');
            $table->string('url_archivo', 500)->nullable()->change();
        });

        // archivo_empresa: contenido binario + mime
        Schema::table('archivo_empresa', function (Blueprint $table) {
            $table->longText('contenido')->nullable()->after('url_archivo');
            $table->string('mime_type', 100)->nullable()->after('contenido');
            $table->string('url_archivo', 500)->nullable()->change();
        });

        // datos_empresa: logo en BD
        Schema::table('datos_empresa', function (Blueprint $table) {
            $table->longText('logo_contenido')->nullable()->after('logo_empresa');
            $table->string('logo_mime', 50)->nullable()->after('logo_contenido');
        });
    }

    public function down(): void
    {
        Schema::table('talento_archivo', function (Blueprint $table) {
            $table->dropColumn(['contenido', 'mime_type']);
        });

        Schema::table('archivo_empresa', function (Blueprint $table) {
            $table->dropColumn(['contenido', 'mime_type']);
        });

        Schema::table('datos_empresa', function (Blueprint $table) {
            $table->dropColumn(['logo_contenido', 'logo_mime']);
        });
    }
};
