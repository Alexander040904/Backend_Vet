<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function activar(int $assigned_vet_id, bool $status = true)
    {
        $this->status = $status;
        $this->assigned_vet_id = $assigned_vet_id;
        $this->save();
    }
}
