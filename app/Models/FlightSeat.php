<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightSeat extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'flight_id',
        'row',
        'column',
        'class_type',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean', 
    ];

    public function flight() {
        return $this->belongsTo(Flight::class);
    }
}
