<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TransactionPassanger;
use App\Models\TransactionPassenger; 
use Illuminate\Http\Request;

class TransactionPassengerController extends Controller
{
    public function index($transactionId)
    {
        $passengers = TransactionPassanger::where('transaction_id', $transactionId)->paginate(10);
        return response()->json($passengers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'flight_seat_id' => 'required|exists:flight_seats,id',
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string|max:3',  
        ]);

        $passenger = TransactionPassanger::create($validated);

        return response()->json($passenger, 201);
    }

    public function show($id)
    {
        $passenger = TransactionPassanger::findOrFail($id);
        return response()->json($passenger);
    }

    public function update(Request $request, $id)
    {
        $passenger = TransactionPassanger::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'date_of_birth' => 'sometimes|required|date',
            'nationality' => 'sometimes|required|string|max:3',
        ]);

        $passenger->update($validated);

        return response()->json($passenger);
    }

    public function destroy($id)
    {
        $passenger = TransactionPassanger::findOrFail($id);
        $passenger->delete();

        return response()->json(['message' => 'Passenger deleted successfully'], 200);
    }
}

