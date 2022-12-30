<?php

declare(strict_types=1);

namespace VasilDakov\Postcode\Validator;

interface ValidatorInterface
{
    public function isValid(string $value): bool;
}
