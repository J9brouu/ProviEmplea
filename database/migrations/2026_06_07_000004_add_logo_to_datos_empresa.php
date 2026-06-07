<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('datos_empresa', function (Blueprint $table) {
            $table->string('logo_empresa')->nullable()->after('beneficios_empresa');
        });
    }

    public function down(): void
    {
        Schema::table('datos_empresa', function (Blueprint $table) {
            $table->dropColumn('logo_empresa');
        });
    }
};
