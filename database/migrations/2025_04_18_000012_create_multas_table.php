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
        Schema::create('multas', function (Blueprint $table) {
            $table->id('idMulta')->comment('PK autoincremental para la multa.');
            // Relación con el usuario que tiene la multa
            $table->uuid('idUsuario'); // Coincide con el tipo de Usuario.idUsuario
            // Relación opcional con el préstamo que originó la multa
            $table->unsignedBigInteger('idPrestamo')->nullable(); // Debe coincidir con el tipo de Prestamo.idPrestamo
            $table->decimal('monto', 8, 2)->comment('Monto de la multa');
            $table->string('motivo', 255)->comment('Ej: Retraso en devolución, Daño de material');
            $table->enum('estado_multa', ['Pendiente', 'Pagada', 'Condonada'])->default('Pendiente')->index();
            $table->dateTime('fecha_generacion');
            $table->dateTime('fecha_pago')->nullable();
            $table->text('notas_pago')->nullable()->comment('Referencia de pago, método, etc.');
            $table->uuid('idUsuarioBibliotecarioCondono')->nullable()->comment('Quién condonó la multa (FK a Usuario)');
            $table->timestamps(); // created_at, updated_at

            // Claves foráneas
             $table->foreign('idUsuario')
                  ->references('id')->on('usuarios') // Asegúrate que la tabla se llame 'usuarios'
                  ->onDelete('CASCADE'); // Si se borra el usuario, se borran sus multas

             $table->foreign('idPrestamo')
                  ->references('idPrestamo')->on('prestamos')
                  ->onDelete('SET NULL'); // Si se borra el préstamo, la multa queda registrada pero sin el préstamo asociado

             // $table->foreign('idUsuarioBibliotecarioCondono')->references('idUsuario')->on('usuarios')->onDelete('SET NULL');

             // Índices
             $table->index('fecha_generacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multas');
    }
};
