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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id(); // PK autoincremental
            $table->string('name')->unique()->comment('Nombre único del permiso (ej: catalogo:items:crud)');
            $table->string('group')->nullable()->index()->comment('Grupo lógico para UI (ej: Catálogo, Usuarios)');
            $table->text('description')->nullable()->comment('Descripción amigable del permiso');
            // $table->timestamps(); // Opcional: si quieres rastrear cuándo se creó/modificó un permiso
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
