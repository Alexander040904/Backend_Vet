<?php

namespace App\Listeners;

use App\Events\EmergencyAcceptedEvent;
use App\Models\PrivateChat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewChatCreateListener
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
    public function handle(EmergencyAcceptedEvent $event): void
    {
        //
        PrivateChat::create([
            'client_id' => $event->emergency->client_id,
            'vet_id' => $event->emergency->assigned_vet_id,
            'emergency_id' => $event->emergency->id
        ]);
    }
}
