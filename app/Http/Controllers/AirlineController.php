<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirlineController extends Controller
{
    public function index()
    {
        $airlines = Airline::get();

        return response()->json($airlines);
    }

    public function show($name)
    {
        $airline = Airline::where('name', $name)->firstOrFail();

        return response()->json([
            'airline' => $airline,
            'logo_url' => $airline->logo ? asset('storage/' . $airline->logo) : null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:airlines',
            'name' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['code', 'name']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('airlines', 'public');
        }

        $airline = Airline::create($data);

        return response()->json([
            'message' => 'Airline created successfully',
            'airline' => $airline,
            'logo_url' => $airline->logo ? asset('storage/' . $airline->logo) : null
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $airline = Airline::findOrFail($id);

        $request->validate([
            'code' => 'string|unique:airlines,code,' . $airline->id,
            'name' => 'string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['code', 'name']);

        if ($request->hasFile('logo')) {
            if ($airline->logo) {
                Storage::disk('public')->delete($airline->logo);
            }
            $data['logo'] = $request->file('logo')->store('airlines', 'public');
        }

        $airline->update($data);

        return response()->json([
            'message' => 'Airline updated successfully',
            'airline' => $airline,
            'logo_url' => $airline->logo ? asset('storage/' . $airline->logo) : null
        ]);
    }

    public function destroy($id)
    {
        $airline = Airline::findOrFail($id);

        if ($airline->logo) {
            Storage::disk('public')->delete($airline->logo);
        }

        $airline->delete();

        return response()->json(['message' => 'Airline deleted successfully']);
    }
}


