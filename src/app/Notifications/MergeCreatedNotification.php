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

    public function __construct(EmergencyRequest $emergency)
    {
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
            'message' => 'The ' . $this->emergency->species . ' have ' . $this->emergency->symptoms,
            'type'    => 'emergency',
        ]);
    }

    // Canal privado para admins
    public function broadcastOn(): array
    {
        return [
            new \Illuminate\Broadcasting\PrivateChannel('emergencies.admin')
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
