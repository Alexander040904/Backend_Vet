<?php

namespace App\Listeners;

use App\Events\EmergencyRequestCreatedEvent;
use App\Notifications\MergeCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmergencyRequestCreatedListener
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
    public function handle(EmergencyRequestCreatedEvent $event): void
    {
        $admins = \App\Models\User::where('role_id', 1)->get();

        foreach ($admins as $admin) {
            $admin->notify(new MergeCreatedNotification($event->mergencyRequest));
        }
    }
}
