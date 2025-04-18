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
        // Tabla basada en tu script SQL
        Schema::create('UnidadAcademica', function (Blueprint $table) {
            $table->string('idUnidadAcademica', 15)->primary()->comment('Clave única de la unidad académica (e.g., ESCOM, UPIITA). PK.');
            $table->string('nombre', 255)->comment('Nombre completo de la unidad académica.');
            $table->string('siglas', 20)->nullable()->comment('Siglas o acrónimo de la unidad.');
            $table->string('fotografia', 255)->nullable()->comment('Ruta relativa o URL a la imagen/logo de la unidad.');
            $table->index('nombre', 'idx_unidad_nombre'); // Índice explícito como en tu SQL
            // No añadimos timestamps si no los necesitas para esta tabla catálogo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UnidadAcademica');
    }
};
