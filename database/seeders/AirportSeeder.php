<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    public function run()
    {
        $airports = [
            [
                'name' => 'Cairo International Airport',
                'image' => 'airports/Cairo.jpg',
                'city' => 'Cairo',
                'country' => 'Egypt',
                'iata_code' => 'CAI',
            ],
            [
                'name' => 'Los Angeles International Airport',
                'image' => 'airports/American.jpg',
                'city' => 'Los Angeles',
                'country' => 'USA',
                'iata_code' => 'LAX',
            ],
            [
                'name' => 'Franjo Tuđman Airport',
                'image' => 'airports/croatia.jpg',
                'city' => 'Zagreb',
                'country' => 'Croatia',
                'iata_code' => 'ZAG',
            ],
            [
                'name' => 'Dubai International Airport',
                'image' => 'airports/emarate.jpg',
                'city' => 'Dubai',
                'country' => 'UAE',
                'iata_code' => 'DXB',
            ],
            [
                'name' => 'Leonardo da Vinci–Fiumicino Airport',
                'image' => 'airports/italia.jpg',
                'city' => 'Rome',
                'country' => 'Italy',
                'iata_code' => 'FCO',
            ],
            [
                'name' => 'Warsaw Chopin Airport',
                'image' => 'airports/polandia.jpg',
                'city' => 'Warsaw',
                'country' => 'Poland',
                'iata_code' => 'WAW',
            ],
            [
                'name' => 'Hamad International Airport',
                'image' => 'airports/Qatar.jpg',
                'city' => 'Doha',
                'country' => 'Qatar',
                'iata_code' => 'DOH',
            ],
            [
                'name' => 'Zurich Airport',
                'image' => 'airports/Swiss.jpg',
                'city' => 'Zurich',
                'country' => 'Switzerland',
                'iata_code' => 'ZRH',
            ],
            [
                'name' => 'Unknown Airport',
                'image' => 'airports/default.jpg', 
                'city' => 'Unknown',
                'country' => 'Unknown',
                'iata_code' => 'UNK',
            ],
            [
                'name' => 'Starlux Airlines',
                'image' => 'airlines/starlux.jpg',
                'city' => 'Taipei',
                'country' => 'Taiwan',
                'iata_code' => 'JX',
            ]            
        ];

        foreach ($airports as $airport) {
            Airport::create($airport);
        }
    }
}
