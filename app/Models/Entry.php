<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entry extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'price_id',
        'price',
        'ref_code',
        'number',
        'status',
    ];
    
    public function prices(): BelongsTo
    {
        return $this->belongsTo(Price::class,'price_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
