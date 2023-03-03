<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Apartment;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::factory()->count(100)-> make() -> each(function($a) {

            // Foreign Key apartment_id
            $apartment = Apartment::inRandomOrder() -> first();

            $a -> apartment() -> associate($apartment);

            $a -> save();
        });
    }
}
