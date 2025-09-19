<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\String_;

class EmergencyRequest extends Model
{
    //
    protected $fillable = [
        'client_id',
        'species',
        'breed',
        'weight',
        'symptoms',
        'description',
    ];



    public function activar(int $assigned_vet_id, string $status = 'accepted')
    {
        $this->status = $status;
        $this->assigned_vet_id = $assigned_vet_id;
        $this->save();
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Relación con el veterinario asignado
    public function assignedVet()
    {
        return $this->belongsTo(User::class, 'assigned_vet_id');
    }
    public function privateChat()
    {
        return $this->hasOne(PrivateChat::class, 'emergency_id');
    }
}
