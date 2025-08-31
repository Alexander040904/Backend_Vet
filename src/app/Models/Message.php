<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $guarded = [];

    public function privateChat()
    {
        return $this->belongsTo(PrivateChat::class, 'private_chat_id');
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
