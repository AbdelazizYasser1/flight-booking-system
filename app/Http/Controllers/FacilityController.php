<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FlightClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::all()->map(function ($facility) {
            return [
                'id' => $facility->id,
                'name' => $facility->name,
                'description' => $facility->description,
                'image_url' => $facility->image_url, 
            ];
        });

        return response()->json($facilities);
    }

    public function show($name)
    {
        $facility = Facility::where('name', $name)->first();

        if (!$facility) {
            return response()->json(['message' => 'Facility not found'], 404);
        }

        return response()->json([
            'id' => $facility->id,
            'name' => $facility->name,
            'description' => $facility->description,
            'image_url' => $facility->image_url, 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('facilities', 'public');

        $facility = Facility::create([
            'image' => $imagePath,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($facility, 201);
    }

    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($facility->image && Storage::disk('public')->exists($facility->image)) {
                Storage::disk('public')->delete($facility->image);
            }
            $facility->image = $request->file('image')->store('facilities', 'public');
        }

        $facility->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $facility->image, 
        ]);

        return response()->json($facility);
    }

    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);

        if ($facility->image && Storage::disk('public')->exists($facility->image)) {
            Storage::disk('public')->delete($facility->image);
        }

        $facility->delete();

        return response()->json(['message' => 'Facility deleted successfully']);
    }

    public function attachFacilityToFlightClass($facilityId, $flightClassId)
    {
        $facility = Facility::find($facilityId);
        $flightClass = FlightClass::find($flightClassId);

        if (!$facility || !$flightClass) {
            return response()->json(['message' => 'Facility or FlightClass not found'], 404);
        }

        $flightClass->facilities()->attach($facility);

        return response()->json(['message' => 'Facility successfully attached to FlightClass']);
    }

    public function detachFacilityFromFlightClass($facilityId, $flightClassId)
    {
        $facility = Facility::find($facilityId);
        $flightClass = FlightClass::find($flightClassId);

        if (!$facility || !$flightClass) {
            return response()->json(['message' => 'Facility or FlightClass not found'], 404);
        }

        $flightClass->facilities()->detach($facility);

        return response()->json(['message' => 'Facility successfully detached from FlightClass']);
    }
}
