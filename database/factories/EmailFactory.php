<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'message_id' => Message::factory(),
            'subject' => collect($this->faker->words())->join(' '),
            'from_email' => $this->faker->email(),
            'from_name' => $this->faker->name(),
            'to_email' => $this->faker->email(),
            'to_name' => $this->faker->name(),
            'body' => $this->faker->randomHtml(),
            'status' => TransactionStatus::POSTED->value,
            'posted_at' => Carbon::now(),
        ];
    }
}
