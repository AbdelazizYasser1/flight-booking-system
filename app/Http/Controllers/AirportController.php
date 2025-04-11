<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirportController extends Controller
{
    public function index()
    {
        return response()->json(Airport::all());
    }

    public function show($name)
    {
        $airport = Airport::where('name', $name)->first();

        if (!$airport) {
            return response()->json(['message' => 'Airport not found'], 404);
        }

        return response()->json($airport);
    }

    public function store(Request $request)
    {
        $request->validate([
            'iata_code' => 'required|string|max:3|unique:airports',
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('airports', 'public');

        $airport = Airport::create([
            'iata_code' => $request->iata_code,
            'name' => $request->name,
            'image' => $imagePath,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        return response()->json($airport, 201);
    }

    public function update(Request $request, $id)
    {
        $airport = Airport::find($id);

        if (!$airport) {
            return response()->json(['message' => 'Airport not found'], 404);
        }

        $request->validate([
            'iata_code' => 'string|max:3|unique:airports,iata_code,' . $airport->id,
            'name' => 'string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'city' => 'string',
            'country' => 'string',
        ]);

        if ($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('airports', 'public');

            if ($airport->image) {
                Storage::disk('public')->delete($airport->image);
            }

            $airport->image = $newImagePath;
        }

        $airport->update([
            'iata_code' => $request->iata_code ?? $airport->iata_code,
            'name' => $request->name ?? $airport->name,
            'city' => $request->city ?? $airport->city,
            'country' => $request->country ?? $airport->country,
            'image' => $airport->image,
        ]);

        return response()->json($airport);
    }

    public function destroy($id)
    {
        $airport = Airport::find($id);

        if (!$airport) {
            return response()->json(['message' => 'Airport not found'], 404);
        }

        $airport->delete();

        return response()->json(['message' => 'Airport deleted successfully']);
    }
}

