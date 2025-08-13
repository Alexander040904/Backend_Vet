<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class MyNotification extends DatabaseNotification
{
    //
    protected $visible = ['id', 'data', 'read_at', 'notifiable_id'];
}
