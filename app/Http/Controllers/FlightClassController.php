<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FlightClass;
use Illuminate\Http\Request;

class FlightClassController extends Controller
{
    public function index()
    {
        $flightClasses = FlightClass::with(['flight', 'facilities', 'transactions'])->paginate(10);
        return response()->json($flightClasses);
    }

    public function show($id)
    {
        $flightClass = FlightClass::with(['flight', 'facilities', 'transactions'])->findOrFail($id);
        return response()->json($flightClass);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'class_type' => 'required|in:economy,business',
            'price' => 'required|integer|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);

        $flightClass = FlightClass::create($validatedData);
        return response()->json($flightClass->load(['flight', 'facilities', 'transactions']), 201);
    }

    public function update(Request $request, $id)
    {
        $flightClass = FlightClass::findOrFail($id);

        $validatedData = $request->validate([
            'flight_id' => 'exists:flights,id',
            'class_type' => 'in:economy,business',
            'price' => 'integer|min:0',
            'total_seats' => 'integer|min:1',
        ]);

        $flightClass->update($validatedData);
        return response()->json($flightClass->load(['flight', 'facilities', 'transactions']));
    }

    public function destroy($id)
    {
        $flightClass = FlightClass::findOrFail($id);
        $flightClass->delete();
        return response()->json(['message' => 'Flight class deleted successfully']);
    }
}
