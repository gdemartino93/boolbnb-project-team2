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
                'type' => '24h',
                'price' => '2.99'
            ],
            
            [
                'type' => '72h',
                'price' => '5.99'
            ],

            [
                'type' => '144h',
                'price' => '9.99'
            ]
        ]);
    }
}
