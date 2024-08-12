<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'ticket_id',
        'ride_id',
        'price',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }

    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class,'ride_id');
    }
}
