<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;

class VerifyEmailNotification extends BaseVerifyEmail
{
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Confirma tu correo en SIBIPN') // Asunto personalizado
            ->markdown('emails.verify', ['url' => $url]); // <-- APUNTA A TU VISTA
    }
}
