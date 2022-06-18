<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Email extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => TransactionStatus::class,
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class, EmailAttachment::class);
    }
}
