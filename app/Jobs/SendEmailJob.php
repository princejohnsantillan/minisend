<?php

namespace App\Jobs;

use App\Models\Email;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Email $email
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $email = new class extends Mailable {
                public function build()
                {
                    return $this;
                }
            };

            $email->subject($this->email->subject);

            $email->from($this->email->from_email, $this->email->from_name);

            $email->to($this->email->to_email, $this->email->to_name);

            if ($this->email->html !== null) {
                $email->html($this->email->html);
            }

            if ($this->email->text !== null) {
                $email->text('plain', ['text' => $this->email->text]);
            }

            foreach ($this->email->attachments as $attachment) {
                if (Storage::disk($attachment->disk->value)->exists($attachment->storage_filename)) {
                    $email->attachFromStorageDisk(
                        $attachment->disk->value,
                        $attachment->storage_filename,
                        $attachment->original_filename
                    );
                }
            }

            Mail::send($email);

            $this->email->sent();
        } catch (Exception $e) {
            report($e);

            $this->email->failed($e->getMessage());
        }
    }
}
