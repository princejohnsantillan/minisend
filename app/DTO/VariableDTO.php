<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class VariableDTO extends DataTransferObject
{
    public string $email;

    /** @var \App\DTO\SubstitutionDTO[] */
    #[CastWith(ArrayCaster::class, itemType: SubstitutionDTO::class)]
    public array $substitutions;
}
