<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Flight;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->is_admin 
            ? Transaction::with(['flight', 'flightClass', 'promoCode'])->paginate(10)
            : Transaction::where('user_id', Auth::id())->with(['flight', 'flightClass', 'promoCode'])->paginate(10);

        return response()->json($transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['flight', 'flightClass', 'promoCode'])->findOrFail($id);

        if (!Auth::user()->is_admin && $transaction->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'flight_class_id' => 'required|exists:flight_classes,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'number_of_passenger' => 'required|integer|min:1',
            'promo_code_id' => 'nullable|exists:promo_codes,id',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $validatedData['code'] = 'TRX-' . strtoupper(Str::random(10));
        $validatedData['user_id'] = Auth::id();

        $flight = Flight::findOrFail($validatedData['flight_id']);
        $ticketPrice = $flight->price;
        $subtotal = $ticketPrice * $validatedData['number_of_passenger'];
        $grandtotal = $subtotal;

        if (!empty($validatedData['promo_code_id'])) {
            $promo = PromoCode::where('id', $validatedData['promo_code_id'])
                        ->where('is_used', false)
                        ->where('valid_until', '>', now())
                        ->first();

            if ($promo) {
                $grandtotal -= ($promo->discount_type === 'fixed') 
                    ? $promo->discount 
                    : ($grandtotal * $promo->discount / 100);

                $promo->update(['is_used' => true]);
            }
        }

        $validatedData['subtotal'] = $subtotal;
        $validatedData['grandtotal'] = max(0, $grandtotal);

        $transaction = Transaction::create($validatedData);

        return response()->json($transaction, 201);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        if (!Auth::user()->is_admin && $transaction->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'flight_id' => 'sometimes|exists:flights,id',
            'flight_class_id' => 'sometimes|exists:flight_classes,id',
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email',
            'phone' => 'sometimes|string|max:20',
            'number_of_passenger' => 'sometimes|integer|min:1',
            'payment_status' => 'sometimes|in:pending,paid,failed',
        ]);

        if (isset($validatedData['payment_status']) && $validatedData['payment_status'] === 'paid' && !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized to change payment status'], 403);
        }

        $transaction->update($validatedData);

        return response()->json($transaction);
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        if (!Auth::user()->is_admin && $transaction->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}
