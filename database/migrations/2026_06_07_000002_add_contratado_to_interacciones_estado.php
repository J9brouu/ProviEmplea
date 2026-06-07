<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE interacciones MODIFY COLUMN estado ENUM('pendiente','contactado','entrevista','seleccionado','rechazado','contratado') NOT NULL DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE interacciones MODIFY COLUMN estado ENUM('pendiente','contactado','entrevista','seleccionado','rechazado') NOT NULL DEFAULT 'pendiente'");
    }
};
