<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'iata_code',
        'name', 
        'image', 
        'city', 
        'country'
    ];

    protected $appends = ['image_url']; 

    public function flightSegments()
    {
        return $this->hasMany(FlightSegment::class); 
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('airports/default.jpg');
    }
}
