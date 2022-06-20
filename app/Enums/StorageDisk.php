<?php

namespace App\Enums;

use Illuminate\Support\Facades\Storage;

enum StorageDisk: string
{
    case LOCAL = 'local';
    case ATTACHMENTS = 'attachments';
    case AWS = 's3';

    public function storage()
    {
        return Storage::disk($this->value);
    }
}
