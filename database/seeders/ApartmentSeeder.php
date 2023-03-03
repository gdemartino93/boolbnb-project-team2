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

            // FK User
            $user = User::inRandomOrder()->first();

            $a->user()->associate($user);

            $a->save();

            // FK View
            $views = View::inRandomOrder()->first();

            $a->views()->associate($views);

            $a->save();

            // FK Message
            $messages = Message::inRandomOrder()->first();

            $a->messages()->associate($messages);

            $a->save();

            // M a N additional_service_apartment
            $additionalServices = AdditionalService::inRandomOrder()->limit(rand(1, 5))->get();

            $a->additionalServices()->attach($additionalServices);

            // M a N additional_service_apartment
            $sponsorships = Sponsorship::inRandomOrder()->limit(rand(1, 5))->get();

            $a->sponsorships()->attach($sponsorships);
        });
    }
}