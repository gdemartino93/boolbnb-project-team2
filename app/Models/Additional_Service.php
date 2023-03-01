<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_Service extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'description'
    ];
}
