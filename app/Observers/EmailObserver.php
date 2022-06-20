<?php

namespace App\Observers;

use App\Jobs\SendEmailJob;
use App\Models\Email;

class EmailObserver
{
    public $afterCommit = true;

    public function created(Email $email)
    {
        dispatch(new SendEmailJob($email));
    }
}
