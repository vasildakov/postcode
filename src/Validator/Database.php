<?php

declare(strict_types=1);

namespace VasilDakov\Postcode\Validator;

final class Database implements ValidatorInterface
{
    public function isValid(string $value): bool
    {
        return false;
    }
}
