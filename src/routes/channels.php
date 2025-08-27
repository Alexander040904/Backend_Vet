<?php

use App\Models\PrivateChat;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('emergencies.admin', function ($user) {
    return $user->role_id === 1;
});
Broadcast::channel('client.{id}', function ($user, $id) {
    // Solo el cliente dueño de la emergencia puede escuchar
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    $chat = PrivateChat::find($chatId);

    if (! $chat) {
        return false;
    }

    return (int) $user->id === (int) $chat->client_id || (int)$user->id === (int)$chat->vet_id;
});



Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
