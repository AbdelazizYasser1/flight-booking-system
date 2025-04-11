<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FlightClass;

class FlightClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flightClasses = [];

        for ($i = 1; $i <= 20; $i++) {
            $flightClasses[] = [
                'flight_id'   => rand(1, 10), 
                'class_type'  => ['economy', 'business'][rand(0, 1)],
                'price'       => rand(100, 500),
                'total_seats' => rand(50, 200),
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        FlightClass::insert($flightClasses);
    }
}
