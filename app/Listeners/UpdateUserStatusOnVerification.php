<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified; // Evento que escuchamos
use App\Models\Usuario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserStatusOnVerification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        // $event->user contiene la instancia del usuario que acaba de ser verificado
        // Asegurémonos que sea una instancia de nuestro modelo Usuario
        if ($event->user instanceof Usuario) {
            $user = $event->user;

            // Solo actualizamos el estado si estaba 'PendienteConfirmacion'
            if ($user->estadoUsuario === 'PendienteConfirmacion') {
                $user->estadoUsuario = 'Activo'; // Cambiamos el estado
                $user->save(); // Guardamos el cambio en la base de datos

                // Opcional: Puedes añadir logs o disparar otros eventos aquí si es necesario
                // \Log::info("Usuario {$user->id} activado tras verificación de email.");
            }
        }
    }
}
