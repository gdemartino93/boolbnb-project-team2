<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AdditionalService;

class AdditionalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AdditionalService::factory()->count(50)->create();
        DB::table('additional_services') -> insert([

            [
                'name' => 'Wifi',
            ],
            [
                'name' => 'Piscina'
            ],
            [
                'name' => 'Parcheggio privato'
            ],
            [
                'name' => 'Sauna'
            ],
            [
                'name' => 'Tv'
            ],
            [
                'name' => 'Climatizzatore centralizzato'
            ],
            [
                'name' => 'Ingresso privato'
            ],
            [
                'name' => 'Allarme antincendio'
            ],
            [
                'name' => 'Giardino'
            ],
            [
                'name' => 'Cucina'
            ],
            [
                'name' => 'Frigorifero'
            ],
            [
                'name' => 'Lavastoviglie'
            ],
            [
                'name' => 'Acqua calda'
            ],
            [
                'name' => 'Biancheria da letto'
            ],
            [
                'name' => 'Cuscini e coperte extra'
            ],
            [
                'name' => 'Estintore' 
            ]
        ]);
    }
}