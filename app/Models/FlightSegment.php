<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightSegment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sequence',
        'flight_id',
        'departure_airport_id',
        'arrival_airport_id',
        'departure_time',
        'arrival_time'
    ];

    protected $casts = [
        'departure_time' => 'datetime:Y-m-d H:i:s',
        'arrival_time' => 'datetime:Y-m-d H:i:s',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }
}
