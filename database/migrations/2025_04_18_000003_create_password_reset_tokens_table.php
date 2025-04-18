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
        // Crea la tabla con el esquema estándar de Laravel
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            // Columna para almacenar el identificador del usuario (email o correoInstitucional)
            // Laravel por defecto usa 'email' como nombre de columna aquí, y es un string.
            $table->string('email')->primary();
            // Columna para el token hasheado
            $table->string('token');
            // Timestamp de creación (usado para la expiración del token)
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
