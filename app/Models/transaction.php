<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'flight_id',
        'flight_class_id',
        'name',
        'email',
        'phone',
        'number_of_passenger',
        'promo_code_id',
        'payment_status',
        'subtotal',
        'grandtotal'
    ];

    public function flight() {
        return $this->belongsTo(Flight::class);
    }

    public function flightClass() {
        return $this->belongsTo(FlightClass::class);
    }

    public function promoCode() {
        return $this->belongsTo(PromoCode::class);
    }

    public function passengers() {
        return $this->hasMany(TransactionPassanger::class);
    }
}
