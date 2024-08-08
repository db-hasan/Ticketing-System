<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'ref_code',
        'number',
        'status',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(Ticket_details::class);
    }
    
}
