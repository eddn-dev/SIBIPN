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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id('idPrestamo')->comment('PK autoincremental para el préstamo.'); // Usamos ID simple aquí
            // Relación con el ejemplar prestado
            $table->uuid('idEjemplar');
            // Relación con el usuario que tiene el préstamo
            $table->uuid('idUsuario'); // Coincide con el tipo de Usuario.idUsuario
            $table->dateTime('fecha_prestamo');
            $table->dateTime('fecha_vencimiento');
            $table->dateTime('fecha_devolucion')->nullable()->comment('Se llena al devolver el ejemplar');
            $table->unsignedTinyInteger('renovaciones')->default(0)->comment('Número de veces que se ha renovado');
            $table->enum('tipo_prestamo', ['Domicilio', 'Sala', 'Interbibliotecario', 'Especial'])->default('Domicilio');
            $table->uuid('idUsuarioBibliotecarioPrestamo')->nullable()->comment('Quién realizó el préstamo (FK a Usuario)');
            $table->uuid('idUsuarioBibliotecarioDevolucion')->nullable()->comment('Quién registró la devolución (FK a Usuario)');
            $table->timestamps(); // created_at, updated_at

            // Claves foráneas
             $table->foreign('idEjemplar')
                  ->references('idEjemplar')->on('ejemplares')
                  ->onDelete('CASCADE'); // O RESTRICT si quieres mantener historial aunque se borre ejemplar?

             $table->foreign('idUsuario')
                  ->references('id')->on('usuarios') // Asegúrate que la tabla se llame 'usuarios'
                  ->onDelete('CASCADE'); // Si se borra el usuario, se borran sus préstamos

            // FKs opcionales para bibliotecarios (si necesitas rastrear quién hizo qué)
            // $table->foreign('idUsuarioBibliotecarioPrestamo')->references('idUsuario')->on('usuarios')->onDelete('SET NULL');
            // $table->foreign('idUsuarioBibliotecarioDevolucion')->references('idUsuario')->on('usuarios')->onDelete('SET NULL');

            // Índices
            $table->index('fecha_vencimiento');
            $table->index('fecha_devolucion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
