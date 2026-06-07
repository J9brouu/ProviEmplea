<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios_empresa', function (Blueprint $table) {
            $table->string('cargo', 50)->default('RRHH')->after('telefono');
        });
    }

    public function down(): void
    {
        Schema::table('usuarios_empresa', function (Blueprint $table) {
            $table->dropColumn('cargo');
        });
    }
};
