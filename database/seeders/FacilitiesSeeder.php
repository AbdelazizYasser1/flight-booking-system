<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            ['name' => 'Waiting Hall', 'description' => 'A comfortable space to relax before your flight.', 'image' => 'facilities/waiting_hall.jpg'],
            ['name' => 'Business Lounge', 'description' => 'A premium experience for business travelers.', 'image' => 'facilities/business_lounge.jpg'],
            ['name' => 'Free Wi-Fi', 'description' => 'High-speed internet access available for free.', 'image' => 'facilities/wifi.jpg'],
            ['name' => 'Passport Service', 'description' => 'Fast-track passport control and travel assistance.', 'image' => 'facilities/passport.jpg'],
            ['name' => 'Parking', 'description' => 'Secure parking options for short and long stays.', 'image' => 'facilities/parking.jpg'],
            ['name' => 'Boarding Pass', 'description' => 'E-ticketing and printed boarding pass services.', 'image' => 'facilities/boarding.jpg'],
        ];

        foreach ($facilities as $facility) {
            DB::table('facilities')->insert([
                'name' => $facility['name'],
                'description' => $facility['description'],
                'image' => $facility['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
