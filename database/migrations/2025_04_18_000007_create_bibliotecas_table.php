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
        Schema::create('bibliotecas', function (Blueprint $table) {
            // Usamos un ID corto y significativo si existe un código oficial, sino INT/UUID
            $table->string('idBiblioteca', 15)->primary()->comment('Clave única de la biblioteca sede. PK.');
            $table->string('nombre', 255);
            $table->text('direccion')->nullable();
            $table->string('telefono', 50)->nullable();
            $table->text('horarios')->nullable()->comment('Texto descriptivo o JSON con horarios');
            // Relación opcional con UnidadAcademica (si una biblioteca pertenece siempre a una)
            // Asegúrate que el tipo coincida con idUnidadAcademica en la tabla unidades_academicas
            $table->string('idUnidadAcademica', 15)->nullable()->index();
            $table->string('url_mapa')->nullable()->comment('URL a Google Maps, OpenStreetMap, etc.');
            $table->string('foto_url')->nullable()->comment('URL a una foto de la biblioteca');
            $table->timestamps(); // created_at, updated_at

            $table->foreign('idUnidadAcademica')
                   ->references('idUnidadAcademica')->on('unidadacademica') // Asegúrate del nombre correcto de la tabla
                   ->onDelete('SET NULL') // O RESTRICT si no se puede borrar unidad con biblioteca
                   ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibliotecas');
    }
};
