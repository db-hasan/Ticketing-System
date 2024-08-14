<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'price',
        'status',
    ];

    public function ridedetals(): HasMany
    {
        return $this->hasMany(Ticket_details::class);
    }
}
