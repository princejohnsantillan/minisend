<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SubstitutionDTO extends DataTransferObject
{
    public string $key;

    public string $value;
}
