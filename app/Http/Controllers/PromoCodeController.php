<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::select('id', 'code', 'discount_type', 'discount', 'valid_until', 'is_used')
            ->paginate(10);

        return response()->json($promoCodes);
    }

    public function show($code)
    {
        $promoCode = PromoCode::where('code', $code)->firstOrFail();
        return response()->json($promoCode);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:promo_codes,code',
            'discount_type' => 'required|in:fixed,percentage',
            'discount' => 'required|integer|min:1',
            'valid_until' => 'required|date|after:today',
        ]);

        $promoCode = PromoCode::create($request->all());
        return response()->json($promoCode, 201);
    }

    public function update(Request $request, $id)
    {
        $promoCode = PromoCode::findOrFail($id);

        $request->validate([
            'code' => 'string|unique:promo_codes,code,' . $id,
            'discount_type' => 'in:fixed,percentage',
            'discount' => 'integer|min:1',
            'valid_until' => 'date|after:today',
        ]);

        $promoCode->update($request->all());
        return response()->json($promoCode);
    }

    public function destroy($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->delete();
        return response()->json(['message' => 'PromoCode deleted successfully']);
    }

    public function usePromoCode($id)
    {
        $promoCode = PromoCode::where('id', $id)
            ->where('is_used', false)
            ->where('valid_until', '>=', now())
            ->firstOrFail();

        $promoCode->update(['is_used' => true]);

        return response()->json(['message' => 'PromoCode used successfully']);
    }

    public function validatePromoCode($code)
    {
        $promoCode = PromoCode::where('code', $code)
            ->where('is_used', false)
            ->where('valid_until', '>=', now())
            ->first();

        if (!$promoCode) {
            return response()->json(['message' => 'Invalid or expired promo code'], 400);
        }

        return response()->json($promoCode);
    }
}
