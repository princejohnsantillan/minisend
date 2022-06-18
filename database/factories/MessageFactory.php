<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
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
            'type' => 'Email',
            'payload' => <<<'JSON'
                {
                    "from": {
                        "email": "hello@mailersend.com",
                        "name": "MailerSend"
                    },
                    "to": [
                        {
                        "email": "john@mailersend.com",
                        "name": "John Mailer"
                        }
                    ],
                    "subject": "Hello from {$company}!",
                    "text": "This is just a friendly hello from your friends at {$company}.",
                    "html": "<b>This is just a friendly hello from your friends at {$company}.</b>",
                    "variables": [
                        {
                        "email": "john@mailersend.com",
                        "substitutions": [
                            {
                            "key": "company",
                            "value": "MailerSend"
                            }
                        ]
                        }
                    ]
                }
            JSON,
        ];
    }
}
