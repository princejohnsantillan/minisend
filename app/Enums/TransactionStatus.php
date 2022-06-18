<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case POSTED = 'Posted';
    case SENT = 'Sent';
    case FAILED = 'Failed';
}
