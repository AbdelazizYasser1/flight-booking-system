<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Airline;

class FlightSeeder extends Seeder
{
    public function run()
    {
        $egyptAir = Airline::find(1); 
        $qatarAirways = Airline::find(2); 
        $emirates = Airline::find(3); 
        $starluxAirlines = Airline::find(4); 
        $americanAirlines = Airline::find(5); 
        $swissAirlines = Airline::find(6); 
        $lotAirlines = Airline::find(7); 
        $itaAirways = Airline::find(8); 
        $croatiaAirlines = Airline::find(9); 

        $cairoAirport = Airport::find(1); 
        $laAirport = Airport::find(2); 
        $dubaiAirport = Airport::find(4); 
        $zurichAirport = Airport::find(8); 
        $fiumicinoAirport = Airport::find(5); 
        $warsawAirport = Airport::find(6);
        $hamadAirport = Airport::find(7);
        $franjoAirport = Airport::find(3); 

        Flight::create([
            'flight_number' => 'MS101',
            'airline_id' => $egyptAir->id,
            'departure_airport_id' => $cairoAirport->id,
            'arrival_airport_id' => $laAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'QR202',
            'airline_id' => $qatarAirways->id,
            'departure_airport_id' => $dubaiAirport->id,
            'arrival_airport_id' => $zurichAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'EK303',
            'airline_id' => $emirates->id,
            'departure_airport_id' => $hamadAirport->id,
            'arrival_airport_id' => $fiumicinoAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'SL404',
            'airline_id' => $starluxAirlines->id,
            'departure_airport_id' => $cairoAirport->id,
            'arrival_airport_id' => $warsawAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'AA505',
            'airline_id' => $americanAirlines->id,
            'departure_airport_id' => $zurichAirport->id,
            'arrival_airport_id' => $laAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'LX606',
            'airline_id' => $swissAirlines->id,
            'departure_airport_id' => $fiumicinoAirport->id,
            'arrival_airport_id' => $franjoAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'LO707',
            'airline_id' => $lotAirlines->id,
            'departure_airport_id' => $warsawAirport->id,
            'arrival_airport_id' => $zurichAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'AZ808',
            'airline_id' => $itaAirways->id,
            'departure_airport_id' => $hamadAirport->id,
            'arrival_airport_id' => $fiumicinoAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'OU909',
            'airline_id' => $croatiaAirlines->id,
            'departure_airport_id' => $franjoAirport->id,
            'arrival_airport_id' => $dubaiAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'MS110',
            'airline_id' => $egyptAir->id,
            'departure_airport_id' => $cairoAirport->id,
            'arrival_airport_id' => $laAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'MS111',
            'airline_id' => $egyptAir->id,
            'departure_airport_id' => $cairoAirport->id,
            'arrival_airport_id' => $franjoAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'QR212',
            'airline_id' => $qatarAirways->id,
            'departure_airport_id' => $zurichAirport->id,
            'arrival_airport_id' => $hamadAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'EK313',
            'airline_id' => $emirates->id,
            'departure_airport_id' => $fiumicinoAirport->id,
            'arrival_airport_id' => $warsawAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'SL414',
            'airline_id' => $starluxAirlines->id,
            'departure_airport_id' => $dubaiAirport->id,
            'arrival_airport_id' => $zurichAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'AA515',
            'airline_id' => $americanAirlines->id,
            'departure_airport_id' => $hamadAirport->id,
            'arrival_airport_id' => $fiumicinoAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'LX616',
            'airline_id' => $swissAirlines->id,
            'departure_airport_id' => $warsawAirport->id,
            'arrival_airport_id' => $franjoAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'LO717',
            'airline_id' => $lotAirlines->id,
            'departure_airport_id' => $zurichAirport->id,
            'arrival_airport_id' => $cairoAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'AZ818',
            'airline_id' => $itaAirways->id,
            'departure_airport_id' => $fiumicinoAirport->id,
            'arrival_airport_id' => $laAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'OU919',
            'airline_id' => $croatiaAirlines->id,
            'departure_airport_id' => $franjoAirport->id,
            'arrival_airport_id' => $warsawAirport->id,
        ]);

        Flight::create([
            'flight_number' => 'MS120',
            'airline_id' => $egyptAir->id,
            'departure_airport_id' => $cairoAirport->id,
            'arrival_airport_id' => $zurichAirport->id,
        ]);
    }
}
