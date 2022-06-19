<?php

namespace App\Enums;

enum StorageDisk: string
{
    case LOCAL = 'local';
    case ATTACHMENTS = 'attachments';
    case AWS = 's3';
}
