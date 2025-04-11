<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FlightSegment;
use App\Models\Flight;
use App\Models\Airport;
use Faker\Factory as Faker;

class FlightSegmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $flights = Flight::pluck('id')->toArray();
        $airports = Airport::pluck('id')->toArray();

        if (empty($flights) || count($airports) < 2) {
            $this->command->info('Flights or Airports are missing.');
            return;
        }

        $flightSequences = []; 

        for ($i = 0; $i < 20; $i++) {
            $flight_id = $faker->randomElement($flights);

            if (!isset($flightSequences[$flight_id])) {
                $flightSequences[$flight_id] = [];
            }
            
            do {
                $sequence = $faker->numberBetween(1, 5);
            } while (in_array($sequence, $flightSequences[$flight_id]));

            $flightSequences[$flight_id][] = $sequence;

            FlightSegment::create([
                'sequence' => $sequence,
                'flight_id' => $flight_id,
                'departure_airport_id' => $faker->randomElement($airports),
                'arrival_airport_id' => $faker->randomElement($airports),
                'departure_time' => $faker->dateTimeBetween('now', '+1 week'),
                'arrival_time' => $faker->dateTimeBetween('+1 week', '+2 weeks'),
            ]);
        }
    }
}

