<?php

namespace Database\Seeders;

use App\Models\AdditionalService;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Models\View;
use App\Models\Message;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        Apartment::factory()->count(55)->make()->each(function ($a) {

            // FK View
            $view = View::inRandomOrder()->first();

            $a->view()->associate($view);

            $a->save();

            // FK Message
            $message = Message::inRandomOrder()->first();

            $a->message()->associate($message);

            $a->save();

            // M a N additional_service_apartment
            $additionalService = AdditionalService::inRandomOrder()->limit(rand(1, 5))->get();

            $a->additionalServices()->attach($additionalService);

            // M a N additional_service_apartment
            $sponsorship = Sponsorship::inRandomOrder()->limit(rand(1, 5))->get();

            $a->sponsorship()->attach($sponsorship);
        });
    }
}