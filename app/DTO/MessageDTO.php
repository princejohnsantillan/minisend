<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class MessageDTO extends DataTransferObject
{
    public ContactDTO $from;

    /** @var \App\DTO\ContactDTO[] */
    #[CastWith(ArrayCaster::class, itemType: ContactDTO::class)]
    public array $to;

    public string $subject;

    public ?string $text;

    public ?string $html;

    /** @var \App\DTO\VariableDTO[]|null */
    #[CastWith(ArrayCaster::class, itemType: VariableDTO::class)]
    public ?array $variables;

    public function interpolateText(): array
    {
        return collect($this->to)
            ->mapWithKeys(fn (ContactDTO $to) => [$to->email => $this->interpolateTextFor($to)])
            ->toArray();
    }

    public function interpolateTextFor(ContactDTO $contact): ?string
    {
        $text = str($this->text);

        /** @var \App\DTO\VariableDTO */
        $variable = collect($this->variables)
            ->first(fn (VariableDTO $variable) => $variable->email === $contact->email);

        if ($variable === null) {
            return null;
        }

        foreach ($variable->substitutions as $substitution) {
            $text = $text->replace(sprintf('{$%s}', $substitution->variable), $substitution->value);
        }

        return $text->value();
    }

    public function interpolateHtml(): array
    {
        return collect($this->to)
            ->mapWithKeys(fn (ContactDTO $to) => [$to->email => $this->interpolateHtmlFor($to)])
            ->toArray();
    }

    public function interpolateHtmlFor(ContactDTO $contact): ?string
    {
        $html = str($this->html);

        /** @var \App\DTO\VariableDTO */
        $variable = collect($this->variables)
            ->first(fn (VariableDTO $variable) => $variable->email === $contact->email);

        if ($variable === null) {
            return null;
        }

        foreach ($variable->substitutions as $substitution) {
            $html = $html->replace(sprintf('{$%s}', $substitution->variable), $substitution->value);
        }

        return $html->value();
    }
}
