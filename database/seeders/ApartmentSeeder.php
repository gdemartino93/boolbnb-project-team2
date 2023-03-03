<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\AdditionalService;
use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Models\View;
use App\Models\Message;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        Apartment::factory()->count(50)->make()->each(function ($a) {

            // Foreign Key user_id
            $user = User::inRandomOrder() -> first();
            $a -> user() -> associate($user);

            $a -> save();

            // M a N additional_service_apartment
            $additionalServices = AdditionalService::inRandomOrder()->limit(rand(1, 5))->get();

            $a->additionalServices()->attach($additionalServices);

            // M a N additional_service_apartment
            $sponsorships = Sponsorship::inRandomOrder()->limit(rand(1, 3))->get();

            $a->sponsorships()->attach($sponsorships);
        });
    }
}