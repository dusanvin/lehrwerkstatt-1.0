<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends ResetPassword
{
    use Queueable;

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('Passwort zurücksetzen'))
            ->line(Lang::get('Sie erhalten diese Nachricht, weil wir eine Anfrage erhalten haben, das Passwort für diesen Account zurückzusetzen.'))
            ->action(Lang::get('Passwort zurücksetzen'), $url)
            ->line(Lang::get('Der Link zum Zurücksetzen ist :count Minuten gültig.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Falls Sie keine solche Anfrage gestellt haben, müssen Sie nichts weiter tun.'));
    }
}
