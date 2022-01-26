<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Lang;

class CustomVerifyEmail extends VerifyEmail
{
    use Queueable;

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
        ->subject(Lang::get('Verifizieren Sie Ihre E-Mail-Adresse.'))
        ->line(Lang::get('Willkommen!'))
        ->line(Lang::get('Bitte bestätigen Sie Ihre E-Mail-Adresse'))
        ->action(Lang::get('E-Mail-Adresse verifizieren'), $url)
        ->line(Lang::get('Sollten Sie diese E-Mail fälschlicherweise erhalten haben, müssen Sie nichts weiter tun.'));
    }
}
