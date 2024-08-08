<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'status',
    ];

    public function ride(): HasMany
    {
        return $this->hasMany(Ride::class);
    }
}
