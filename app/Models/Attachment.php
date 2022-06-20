<?php

namespace App\Models;

use App\Enums\StorageDisk;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $download_link
 */
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

    public function downloadLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route('attachment.download', ['attachment' =>$this->id])
        );
    }
}
