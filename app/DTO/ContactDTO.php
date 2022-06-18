<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ContactDTO extends DataTransferObject
{
    public string $email;

    public ?string $name;
}
