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
    public function normalise(): String;


    /**
     * Outward code
     *
     * @return String
     */
    public function outward() : String;


    /**
     * Inward code
     *
     * @return String
     */
    public function inward() : String;


    /**
     * Postcode area
     *
     * @return String
     */
    public function area(): String;


    /**
     * Postcode district
     *
     * @return String|null
     */
    public function district() : String;


    /**
     * Postcode sector
     *
     * @return String|null
     */
    public function sector() : String;


    /**
     * Postcode unit
     *
     * @return String
     */
    public function unit() : String;


    /**
     * Subdistrict
     *
     * @return String|null
     */
    public function subdistrict() : String;


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function equals(Postcode $other) : bool;


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function compareTo(Postcode $other): bool;

    
    /**
     * @param  String $value
     * @return bool
     */
    public function isValid(String $value) : bool;
}
