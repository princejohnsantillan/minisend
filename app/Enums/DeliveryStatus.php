<?php

namespace App\Enums;

enum DeliveryStatus: string
{
    case POSTED = 'Posted';
    case SENT = 'Sent';
    case FAILED = 'Failed';
}
