<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FlightSegment;
use Illuminate\Http\Request;

class FlightSegmentController extends Controller
{
    public function index()
    {
        $segments = FlightSegment::select(['id', 'sequence', 'flight_id', 'airport_id', 'time'])
            ->with([
                'flight:id,flight_number,airline_id',
                'airport:id,name,code'
            ])
            ->paginate(10);

        return response()->json($segments);
    }

    public function show($id)
    {
        $segment = FlightSegment::select(['id', 'sequence', 'flight_id', 'airport_id', 'time'])
            ->with([
                'flight:id,flight_number,airline_id',
                'airport:id,name,code'
            ])
            ->find($id);

        if (!$segment) {
            return response()->json(['message' => 'Flight segment not found'], 404);
        }

        return response()->json($segment);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sequence' => 'required|integer',
            'flight_id' => 'required|exists:flights,id',
            'airport_id' => 'required|exists:airports,id',
            'time' => 'required|date',
        ]);

        $segment = FlightSegment::create($validatedData);

        return response()->json($segment->only(['id', 'sequence', 'flight_id', 'airport_id', 'time']), 201);
    }

    public function update(Request $request, $id)
    {
        $segment = FlightSegment::find($id);

        if (!$segment) {
            return response()->json(['message' => 'Flight segment not found'], 404);
        }

        $validatedData = $request->validate([
            'sequence' => 'integer',
            'flight_id' => 'exists:flights,id',
            'airport_id' => 'exists:airports,id',
            'time' => 'date',
        ]);

        $segment->update($validatedData);

        return response()->json($segment->only(['id', 'sequence', 'flight_id', 'airport_id', 'time']));
    }

    public function destroy($id)
    {
        $segment = FlightSegment::find($id);

        if (!$segment) {
            return response()->json(['message' => 'Flight segment not found'], 404);
        }

        $segment->delete();

        return response()->json(['message' => 'Flight segment deleted successfully']);
    }
}
