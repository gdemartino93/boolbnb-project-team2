<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [

        'description',
        'room_number',
        'bed_number',
        'bath_number',
        'square_meters',
        'address',
        'img',
        'visible',
    ];
}