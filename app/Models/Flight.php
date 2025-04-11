<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'flight_number',
        'airline_id',
        'departure_airport_id',
        'arrival_airport_id'
    ];

    public function airline() {
        return $this->belongsTo(Airline::class , 'airline_id');
    }

    public function segments() {
        return $this->hasMany(FlightSegment::class);
    }

    public function departureAirport() {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function classes() {
        return $this->hasMany(FlightClass::class);
    }

    public function seats() {
        return $this->hasMany(FlightSeat::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
