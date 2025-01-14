<?php
namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Spatie\Backup\Notifications\Notifications\BackupWasSuccessfulNotification as BaseNotification;

class CustomBackupWasSuccessfulNotification extends BaseNotification
{
    public function toMail($notifiable)
    {
        $user = auth()->user(); // Obtén el usuario autenticado

        return (new MailMessage)
            ->from($user->email, $user->name) // Ajusta el emisor
            ->subject('Backup Successful')
            ->line('The backup was completed successfully.');
    }
}