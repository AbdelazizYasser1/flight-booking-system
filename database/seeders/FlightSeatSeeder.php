<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FlightSeat;
use App\Models\Flight;
use Faker\Factory as Faker;

class FlightSeatSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $flights = Flight::pluck('id')->toArray();

        if (empty($flights)) {
            $this->command->info('No flights available.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            FlightSeat::create([
                'flight_id' => $faker->randomElement($flights),
                'row' => strtoupper($faker->randomLetter . $faker->randomDigit),
                'column' => strtoupper($faker->randomLetter),
                'class_type' => $faker->randomElement(['economy', 'business']),
                'is_available' => $faker->boolean(80), 
            ]);
        }
    }
}
