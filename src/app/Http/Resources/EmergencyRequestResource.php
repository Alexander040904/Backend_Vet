<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'client_name' => $this->client ? $this->client->name : null,
            'assigned_vet_id' => $this->assigned_vet_id,
            'vet_name' => $this->assignedVet ? $this->assignedVet->name : null,
            'species' => $this->species,
            'breed' => $this->breed,
            'weight' => $this->weight,
            'symptoms' => $this->symptoms,
            'description' => $this->description,
            'status' => $this->status,
            'chat_id' => $this->privateChat ? $this->privateChat->id : null,
            'sent_at' => $this->sent_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
