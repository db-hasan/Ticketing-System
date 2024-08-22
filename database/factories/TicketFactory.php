<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Ticket_details;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'ref_code' => rand(100000, 999999) . date('is'),
            'status' => 1, // Example for status
        ];
    }
}
