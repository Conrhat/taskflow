<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE tareas DROP CONSTRAINT tareas_estado_check');
        DB::statement("ALTER TABLE tareas ADD CONSTRAINT tareas_estado_check CHECK (estado IN ('pendiente', 'en_proceso', 'completada'))");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE tareas DROP CONSTRAINT tareas_estado_check');
        DB::statement("ALTER TABLE tareas ADD CONSTRAINT tareas_estado_check CHECK (estado IN ('pendiente', 'en_progreso', 'completada'))");
    }
};
