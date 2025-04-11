<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'discount_type',
        'discount',
        'valid_until',
        'is_used'
    ];

    protected $casts = [
        'discount' => 'integer',
        'valid_until' => 'datetime',
        'is_used' => 'boolean',
    ];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function scopeValid($query)
    {
        return $query->where('valid_until', '>=', now());
    }

    public function scopeUnused($query)
    {
        return $query->where('is_used', false);
    }
}
