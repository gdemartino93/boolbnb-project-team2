<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'room_number',
        'bed_number',
        'bath_number',
        'square_meters',
        'address',
        'latitude',
        'longitude',
        'img',
        'visible',
    ];

    // many (apartments) to many (sponsorships)
    public function sponsorships() {
        return $this -> belongsToMany(Sponsorship :: class);
    }
}