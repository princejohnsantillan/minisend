<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailAttachment>
 */
class EmailAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email_id' => Email::factory(),
            'attachment_id' => Attachment::factory(),
        ];
    }
}
