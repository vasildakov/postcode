<?php

declare(strict_types=1);

namespace VasilDakov\Postcode\Validator;

final class Regex implements ValidatorInterface
{
    private const UKGOV = "/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/";

    public function isValid(string $value): bool
    {
        if (!\preg_match(self::UKGOV, $value)) {
            return false;
        }
        return true;
    }
}
