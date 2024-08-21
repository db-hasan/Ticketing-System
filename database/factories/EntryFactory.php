<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Entry;
use App\Models\Price;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entry>
 */
class EntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = Price::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        return [
            'user_id' =>  $user->id,
            'price_id' => $price->id,
            'price' => $price->price, 
            'ref_code' => rand(100000, 999999) . date('is'),
            'number' => fake()->phoneNumber(),
            'status' => 1,
        ];
    }
}
