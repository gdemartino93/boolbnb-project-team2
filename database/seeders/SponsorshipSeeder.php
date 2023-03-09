<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('sponsorships') -> insert([
            
            [
                'duration' => '24:00:00',
                'price' => '2.99',
            ],
            
            [
                'duration' => '72:00:00',
                'price' => '5.99',
            ],

            [
                'duration' => '144:00:00',
                'price' => '9.99',
            ]
        ]);
    }
}
