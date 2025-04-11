<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Cache::remember('flights', 60, function () {
            return Flight::select('id', 'flight_number', 'airline_id')
                ->with([
                    'airline:id,name,logo',
                    'segments:id,flight_id,departure_airport_id,arrival_airport_id',
                    'classes:id,flight_id,class_type,price',
                    'seats:id,flight_id,class_type,row,column,is_avaliable'
                ])
                ->get();
        });

        return response()->json($flights);
    }

    public function show($flight_number)
    {
        $flight = Cache::remember("flight_{$flight_number}", 60, function () use ($flight_number) {
            return Flight::select('id', 'flight_number', 'airline_id')
                ->with([
                    'airline:id,name,logo',
                    'segments:id,flight_id,departure_airport_id,arrival_airport_id',
                    'classes:id,flight_id,class_type,price',
                    'seats:id,flight_id,class_type,row,column,is_avaliable'
                ])
                ->where('flight_number', $flight_number)
                ->first();
        });

        if (!$flight) {
            return response()->json(['message' => 'Flight not found'], 404);
        }

        return response()->json($flight);
    }

    public function store(Request $request)
    {
        $request->validate([
            'flight_number' => 'required|string|unique:flights,flight_number',
            'airline_id' => 'required|exists:airlines,id',
        ]);

        $flight = Flight::create($request->only('flight_number', 'airline_id'));

        Cache::forget('flights'); 

        return response()->json($flight, 201);
    }

    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['message' => 'Flight not found'], 404);
        }

        $request->validate([
            'flight_number' => "string|unique:flights,flight_number,{$flight->id}",
            'airline_id' => 'exists:airlines,id',
        ]);

        $flight->update($request->only('flight_number', 'airline_id'));

        Cache::forget('flights'); 
        Cache::forget("flight_{$flight->flight_number}");

        return response()->json($flight);
    }

    public function destroy($id)
    {
        $flight = Flight::find($id);

        if (!$flight) {
            return response()->json(['message' => 'Flight not found'], 404);
        }

        $flight->delete();

        Cache::forget('flights'); 
        Cache::forget("flight_{$flight->flight_number}");

        return response()->json(['message' => 'Flight deleted successfully']);
    }
}
