<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        DB::table('users')->truncate();
        DB::table('airports')->truncate();
        DB::table('airlines')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            AdminSeeder::class,    
            AirlinesSeeder::class,  
            AirportSeeder::class,  
            FlightClassSeeder::class,
            FlightSeeder::class,
            FlightSeatSeeder::class,
            FlightSegmentSeeder::class,
            PromoCodeSeeder::class,
            FacilitiesSeeder::class
        ]);
    }
}

