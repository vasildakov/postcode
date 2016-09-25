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
    public function normalise();


    /**
     * Outward code
     *
     * @return String
     */
    public function outward();


    /**
     * Inward code
     *
     * @return String
     */
    public function inward();


    /**
     * Postcode area
     *
     * @return String
     */
    public function area();


    /**
     * Postcode district
     *
     * @return String|null
     */
    public function district();


    /**
     * Postcode sector
     *
     * @return String|null
     */
    public function sector();


    /**
     * Postcode unit
     *
     * @return String
     */
    public function unit();


    /**
     * Subdistrict
     *
     * @return String|null
     */
    public function subdistrict();


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function equals(Postcode $other);


    /**
     * @param  Postcode $other
     * @return bool
     */
    public function compareTo(Postcode $other);


    /**
     * @param  String $value
     * @return bool
     */
    public function isValid($value);
}
