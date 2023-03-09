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

    
    public function user(){
        
        return $this -> belongsTo(User::class);
    }
    
    public function messages(){

        return $this -> hasMany(Message::class);
    }

    public function views(){

        return $this -> hasMany(View::class);
    }
    
    // many (apartments) to many (sponsorships)
    
    public function sponsorships() {
        
        return $this -> belongsToMany(Sponsorship :: class) -> withTimestamps();
    }
    
    public function additionalServices(){

        return $this -> belongsToMany(AdditionalService::class);
    }
}