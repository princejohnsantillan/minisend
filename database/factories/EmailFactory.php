<?php

namespace Database\Factories;

use App\Enums\DeliveryStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => User::factory(),
            'subject' => $this->faker->sentence(),
            'from_email' => $this->faker->email(),
            'from_name' => $this->faker->name(),
            'to_email' => $this->faker->email(),
            'to_name' => $this->faker->name(),
            'text' => collect($this->faker->sentences(5))->join(' '),
            'html' => $this->faker->randomHtml(),
            'status' => DeliveryStatus::POSTED->value,
            'posted_at' => $this->faker->date(),
        ];
    }
}
