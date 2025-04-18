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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('idReserva')->comment('PK autoincremental para la reserva.');
            // Relación con el registro bibliográfico reservado
            $table->uuid('idRegistroBibliografico');
             // Relación con el usuario que hace la reserva
            $table->uuid('idUsuario'); // Coincide con el tipo de Usuario.idUsuario
            // Relación opcional con el ejemplar específico asignado (cuando esté disponible)
            $table->uuid('idEjemplarAsignado')->nullable();
            $table->dateTime('fecha_reserva');
            $table->dateTime('fecha_disponible')->nullable()->comment('Fecha en que el ejemplar estuvo listo');
            $table->dateTime('fecha_vencimiento_recogida')->nullable()->comment('Fecha límite para recoger');
            $table->string('idBibliotecaRecogida', 15)->comment('Biblioteca donde se debe recoger');
            $table->enum('estado_reserva', ['Pendiente', 'Disponible', 'Cancelada', 'Recogida', 'Vencida'])->default('Pendiente')->index();
            $table->unsignedInteger('posicion_cola')->nullable()->comment('Posición en la cola de espera si aplica');
             $table->timestamps(); // created_at, updated_at

             // Claves foráneas
             $table->foreign('idRegistroBibliografico')
                  ->references('idRegistro')->on('registros_bibliograficos')
                  ->onDelete('CASCADE');

             $table->foreign('idUsuario')
                  ->references('id')->on('usuarios') // Asegúrate que la tabla se llame 'usuarios'
                  ->onDelete('CASCADE');

             $table->foreign('idEjemplarAsignado')
                  ->references('idEjemplar')->on('ejemplares')
                  ->onDelete('SET NULL'); // Si se borra el ejemplar, la reserva sigue pero sin ejemplar asignado

             $table->foreign('idBibliotecaRecogida')
                  ->references('idBiblioteca')->on('bibliotecas')
                  ->onDelete('CASCADE'); // Si se borra la biblioteca, se borran las reservas asociadas a ella para recogida
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
