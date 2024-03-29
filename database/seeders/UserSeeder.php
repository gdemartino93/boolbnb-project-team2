<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'luca1993@gmail.com',
                'password' => Hash::make('luca'),
                'name' => 'Luca',
                'lastname' => 'Rossi',
                'birthdate' => '1990/04/20'
            ],
            [
                'email' => 'luca101@boolean.com',
                'password' => Hash::make('federico'),
                'name' => 'Federico',
                'lastname' => 'Rossi',
                'birthdate' => '1990/04/20'
            ],
            [
                'email' => 'tommy@boolean.com',
                'password' => Hash::make('tommy'),
                'name' => 'Tommy',
                'lastname' => 'Rossi',
                'birthdate' => '1990/04/20'
            ],
            [
                'email' => 'niki@boolean.com',
                'password' => Hash::make('niki'),
                'name' => 'Niki',
                'lastname' => 'Bianchi',
                'birthdate' => '1990/04/20'
            ],
            [
                'email' => 'salvatore@boolean.com',
                'password' => Hash::make('salvatore'),
                'name' => 'Salvatore',
                'lastname' => 'Rossi',
                'birthdate' => '1990/04/20'
            ],
            ]);

            // User::factory()->count(15)->make()->each(function ($a) {

            //     // FK User
            //     $apartment = Apartment::inRandomOrder()->first();
    
            //     $a->apartment()->associate($apartment);
    
            //     $a->save();
            // });
    }
}