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
use Carbon\Carbon;

class ApartmentSeeder extends Seeder
{
    public function run()
    {
        Apartment::factory()->count(50)->make()->each(function ($apartment) {
            $user = User::inRandomOrder()->first();
            $apartment->user()->associate($user);
            $apartment->save();

            $additionalServices = AdditionalService::inRandomOrder()->limit(rand(1, 5))->get();
            $apartment->additionalServices()->attach($additionalServices);

            // 
            $sponsorships = Sponsorship::inRandomOrder()->limit(rand(1, 5))->get();
            $sponsorships->each(function ($sponsorship) use ($apartment) {
            // l'attach passa una data formato timestamp quindi per passarla correttamente nel db dobbiamo convertirla in formato data che si aspetta la colonna
            $expiringDate = Carbon::now()->addDays(rand(-180, 0))->format('Y-m-d');
            $apartment->sponsorships()->attach($sponsorship, ['expiring_date' => $expiringDate]);
            });
        });
    }
}