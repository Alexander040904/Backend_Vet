<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('emergencies.admin', function ($user) {
    return $user->role_id === 1;
});
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
