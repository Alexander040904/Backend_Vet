<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function vet()
    {
        return $this->hasOne(Vet::class);
    }
    // Emergencias creadas por el usuario (cliente)
    public function emergencyRequestsCreated()
    {
        return $this->hasMany(EmergencyRequest::class, 'client_id');
    }

    // Emergencias asignadas al usuario (veterinario)
    public function emergencyRequestsAssigned()
    {
        return $this->hasMany(EmergencyRequest::class, 'assigned_vet_id');
    }
    public function notifications()
    {
        return $this->morphMany(MyNotification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }
}
