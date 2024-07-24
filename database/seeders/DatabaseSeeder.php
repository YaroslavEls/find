<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Review;
use App\Models\Saloon;
use App\Models\Seeker;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            User::factory()->for(
                Seeker::factory(), 
                'userable'
            )->create();

            $user = User::factory()->for(
                Saloon::factory(),
                'userable'
            )->create();
    
            $locations = Location::factory()->count(3)->create([
                'saloon_id' => $user->userable->id
            ]);

            foreach ($locations as $location) {
                Vacancy::factory()->count(3)->create([
                    'location_id' => $location->id,
                    'saloon_id' => $user->userable->id
                ]);
            }
        }
    }
}
