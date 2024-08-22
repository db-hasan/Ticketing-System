<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Entry;
use App\Models\Price;
use App\Models\User;
use App\Models\Ride;
use App\Models\Ticket;
use App\Models\Ticket_details;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket_details>
 */
class Ticket_detailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ticket = Ticket::inRandomOrder()->first();
        $ride = Ride::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
            'ride_id' => $ride->id,
            'price' => $ride->price,
        ];
    }
}
