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
        Schema::create('ejemplares', function (Blueprint $table) {
            $table->uuid('idEjemplar')->primary()->comment('PK UUID para el ejemplar físico.');
            // Relación con el registro bibliográfico al que pertenece
            $table->uuid('idRegistroBibliografico');
            // Relación con la biblioteca donde se encuentra físicamente
            $table->string('idBiblioteca', 15); // Debe coincidir con el tipo de idBiblioteca
            $table->string('codigo_barras', 100)->unique()->comment('Código de barras único del ejemplar.');
            $table->string('signatura_topografica', 100)->nullable()->comment('Clasificación en estantería (CDU, Dewey, etc.)');
            $table->string('ubicacion_especifica', 255)->nullable()->comment('Ej: Estantería 5B, Sala de Consulta');
            $table->enum('estado_ejemplar', ['Disponible', 'Prestado', 'EnProceso', 'EnReparacion', 'Extraviado', 'Retirado', 'Reservado', 'NoAptoPrestamo'])->default('EnProceso')->index();
            $table->text('notas_internas')->nullable()->comment('Notas para el personal bibliotecario');
            $table->boolean('es_donacion')->default(false);
            $table->date('fecha_adquisicion')->nullable();
            $table->timestamps(); // created_at, updated_at

            // Claves foráneas
            $table->foreign('idRegistroBibliografico')
                  ->references('idRegistro')->on('registros_bibliograficos')
                  ->onDelete('CASCADE'); // Si se borra el registro, se borran sus ejemplares

            $table->foreign('idBiblioteca')
                  ->references('idBiblioteca')->on('bibliotecas')
                  ->onDelete('RESTRICT') // No se puede borrar biblioteca si tiene ejemplares
                  ->onUpdate('CASCADE');

             // Índices
             $table->index('signatura_topografica');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejemplares');
    }
};
