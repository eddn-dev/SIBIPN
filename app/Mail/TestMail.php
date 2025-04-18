<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Construye el mensaje.
     */
    public function build()
    {
        return $this
            ->subject('Correo de prueba SIBIPN')
            ->view('emails.test');  // la vista que vamos a crear
    }
}
