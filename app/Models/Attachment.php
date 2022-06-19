<?php

namespace App\Models;

use App\Enums\StorageDisk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'disk' => StorageDisk::class,
    ];

    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }
}
