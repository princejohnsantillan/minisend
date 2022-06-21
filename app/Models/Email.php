<?php

namespace App\Models;

use App\Enums\DeliveryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Email extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'status' => DeliveryStatus::class,
        'posted_at' => 'immutable_datetime',
        'sent_at' => 'immutable_datetime',
        'failed_at' => 'immutable_datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function sent(): bool
    {
        return $this->update([
            'status' => DeliveryStatus::SENT,
            'sent_at' => now(),
        ]);
    }

    public function failed(?string $reason = null): bool
    {
        return $this->update([
            'status' => DeliveryStatus::FAILED,
            'failure_reason' => $reason,
            'failed_at' => now(),
        ]);
    }
}
