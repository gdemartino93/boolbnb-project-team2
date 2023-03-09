<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'mail',
        'name',
    ];

    public function apartment() 
    {
        return $this->belongsTo(Apartment::class);
    }
}

