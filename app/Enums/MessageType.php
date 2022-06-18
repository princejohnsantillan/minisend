<?php

namespace App\Enums;

enum MessageType: string
{
    case SMS = 'SMS';
    case EMAIL = 'Email';
}
