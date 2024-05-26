<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClienteNaoExcluido extends Notification implements ShouldQueue
{
    use Queueable;

    protected $cliente;

    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Cliente não pôde ser excluído, pois possui serviços associados.')
            ->line("Nome do Cliente: {$this->cliente->nome}");
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => 'Cliente não pôde ser excluído, pois possui serviços associados.',
            'cliente_id' => $this->cliente->id
        ];
    }
}

