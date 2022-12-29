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
     * @return String
     */
    public function normalise(): string;


    /**
     * Outward code
     *
     * @return String
     */
    public function outward(): string;


    /**
     * Inward code
     *
     * @return String
     */
    public function inward(): string;


    /**
     * Postcode area
     *
     * @return String
     */
    public function area(): string;


    /**
     * Postcode district
     *
     * @return String|null
     */
    public function district(): string;


    /**
     * Postcode sector
     *
     * @return String|null
     */
    public function sector(): string;


    /**
     * Postcode unit
     *
     * @return String
     */
    public function unit(): string;


    /**
     * Subdistrict
     *
     * @return String|null
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
     * @param  String $value
     * @return bool
     */
    public static function isValid(string $value): bool;
}
