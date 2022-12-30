<?php

/**
 * This file is part of the Postcode
 *
 * @copyright Copyright (c) Vasil Dakov <vasildakov@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VasilDakov\Postcode;

interface PostcodeInterface
{
    /**
     * Normalise Postcode
     *
     * @return string
     */
    public function normalise(): string;


    /**
     * Outward code
     *
     * @return string
     */
    public function outward(): string;


    /**
     * Inward code
     *
     * @return string
     */
    public function inward(): string;


    /**
     * Postcode area
     *
     * @return string
     */
    public function area(): string;


    /**
     * Postcode district
     *
     * @return string
     */
    public function district(): string;


    /**
     * Postcode sector
     *
     * @return string
     */
    public function sector(): string;


    /**
     * Postcode unit
     *
     * @return string
     */
    public function unit(): string;


    /**
     * Subdistrict
     *
     * @return string
     */
    public function subdistrict(): string;


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function equals(Postcode $other): bool;


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function compareTo(Postcode $other): bool;


    /**
     * @param  string $value
     * @return bool
     */
    public static function isValid(string $value): bool;
}
