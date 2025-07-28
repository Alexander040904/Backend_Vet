<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    //
    use HasFactory;
    protected $fillable = [
            'user_id',
            'card_id',
            'experience', 
            'reference',
            'location',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

}
