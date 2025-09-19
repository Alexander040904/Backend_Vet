<?php

namespace App\Notifications;

use App\Models\EmergencyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MergeCreatedNotification extends Notification  implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $emergency;

    public int $userId;

    public function __construct(EmergencyRequest $emergency, int $userId = 0)
    {
        $this->userId = $userId;
        // Se asigna la emergencia

        $this->emergency = $emergency;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Se envía por database y broadcast
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable): array
    {
        return $this->emergency->toArray();
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'id'      => $this->emergency->id,
            'message' => $this->emergency->species . ' tiene ' . $this->emergency->symptoms,
            'type'    => 'emergency',
        ]);
    }

    // Canal privado para admins
    public function broadcastOn(): array
    {
        return [
            new \Illuminate\Broadcasting\PrivateChannel('emergencies.admin.' . $this->userId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'EmergencyNotification';
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
