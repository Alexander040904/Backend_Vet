<?php

namespace App\Events;

use App\Models\EmergencyRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmergencyAcceptedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    /**
     * Create a new event instance.
     * 
     */
    public $emergency;
    public function __construct(EmergencyRequest $emergencyRequest)
    {
        $this->emergency = $emergencyRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('client.' . $this->emergency->client_id),
        ];
    }
    public function broadcastAs(): string
    {
        return 'EmergencyAccepted';
    }
    public function broadcastWith(): array
    {
        return [
            'id' => $this->emergency->id,
            'doctor' => $this->emergency->assignedVet ? $this->emergency->assignedVet->name : '',
            'message' => 'Solicitud de emergencia aceptada por',

        ];
    }
}
