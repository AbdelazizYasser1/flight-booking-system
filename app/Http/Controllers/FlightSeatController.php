<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FlightSeat;
use Illuminate\Http\Request;

class FlightSeatController extends Controller
{
    public function index()
    {
        $seats = FlightSeat::with('flight')->paginate(10);
        return response()->json($seats);
    }

    public function show($id)
    {
        $seat = FlightSeat::with('flight')->find($id);

        if (!$seat) {
            return response()->json(['message' => 'Seat not found'], 404);
        }

        return response()->json($seat);
    }

    public function store(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'row' => 'required|string|max:5',
            'column' => 'required|string|max:5',
            'class_type' => 'required|in:economy,business',
            'is_available' => 'required|boolean',
        ]);

        $seat = FlightSeat::create([
            'flight_id' => $request->flight_id,
            'row' => strtoupper($request->row),
            'column' => strtoupper($request->column),
            'class_type' => $request->class_type,
            'is_available' => $request->is_available,
        ]);

        return response()->json($seat, 201);
    }

    public function update(Request $request, $id)
    {
        $seat = FlightSeat::find($id);

        if (!$seat) {
            return response()->json(['message' => 'Seat not found'], 404);
        }

        $request->validate([
            'flight_id' => 'exists:flights,id',
            'row' => 'string|max:5',
            'column' => 'string|max:5',
            'class_type' => 'in:economy,business',
            'is_available' => 'boolean',
        ]);

        $seat->update([
            'flight_id' => $request->flight_id ?? $seat->flight_id,
            'row' => $request->row ? strtoupper($request->row) : $seat->row,
            'column' => $request->column ? strtoupper($request->column) : $seat->column,
            'class_type' => $request->class_type ?? $seat->class_type,
            'is_available' => $request->is_available ?? $seat->is_available,
        ]);

        return response()->json($seat);
    }

    public function destroy($id)
    {
        $seat = FlightSeat::find($id);

        if (!$seat) {
            return response()->json(['message' => 'Seat not found'], 404);
        }

        $seat->delete();

        return response()->json(['message' => 'Seat deleted successfully']);
    }
}
