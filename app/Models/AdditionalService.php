<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'description'
        
    ];

    public function apartments(){

        return $this -> belongsToMany(Apartment::class); 
    }
}
