<?php

namespace Tests\Feature;

use App\Jobs\SendEmailJob;
use App\Models\Email;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EmailAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_email_record_and_responds_with_an_id_via_a_header()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'subject' => 'A Test!',
            'from' => [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
            ],
            'to' => [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
            ],
            'text' => 'This is a plain text',
            'html' => '<h1>This text is big!</h1>',
        ];

        $response = $this->post('/api/email', $data);

        $emailId = $response->headers->get('X-Email-ID');

        $response->assertHeader('X-Email-ID');

        $this->assertDatabaseHas('emails', [
            'id' => $emailId,
            'user_id' => $user->id,
            'subject' => $data['subject'],
            'from_name'=> $data['from']['name'],
            'from_email'=> $data['from']['email'],
            'to_name'=> $data['to']['name'],
            'to_email'=> $data['to']['email'],
            'text' => $data['text'],
            'html' => $data['html'],
        ]);
    }

    /** @test */
    public function it_dispatches_a_send_email_job_when_an_email_is_created()
    {
        Queue::fake();

        Email::factory()->times(5)->create();

        Queue::assertPushed(SendEmailJob::class, 5);
    }
}
