<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateChat extends Model
{
    //
    protected $guarded = [];

    //El cliente pertenece a un usuario

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    //El veterinario pertenece a un usuario
    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }
    public function emergency()
    {
        return $this->belongsTo(EmergencyRequest::class, 'emergency_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
