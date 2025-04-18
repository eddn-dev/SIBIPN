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
        // Tabla basada en tu script SQL (corregido PK y nombre de tabla)
        Schema::create('rol_admin', function (Blueprint $table) { // Nombre tabla en snake_case
            $table->id()->comment('Identificador único del rol administrativo. PK.'); // PK estándar 'id'
            $table->string('nombreRol', 100)->unique()->comment('Nombre descriptivo del rol. Debe ser único.');
            $table->text('descripcion')->nullable()->comment('Descripción detallada de las funciones del rol.');
            $table->json('permisos')->nullable()->comment('Estructura JSON que define los permisos específicos.');
            // No añadimos timestamps si no los necesitas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_admin');
    }
};
