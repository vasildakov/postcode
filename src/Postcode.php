<?php

declare(strict_types=1);

namespace VasilDakov\Postcode;

use VasilDakov\Postcode\Exception;

/**
 * Postcode
 *
 * @copyright Copyright (c) Vasil Dakov <vasildakov@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
final class Postcode implements PostcodeInterface, \JsonSerializable
{
    /**
     * Regular expression pattern for Outward code
     */

    private const REGEXP_POSTCODE_UKGOV = "/^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2})$/";

    /**
     * Regular expression pattern for Outward code
     */
    private const REGEXP_POSTCODE     = "/^[A-Za-z]{1,2}\d[a-z\d]?\s*\d[A-Za-z]{2}$/i";


    /**
     * Regular expression pattern for Outward code
     */
    private const REGEXP_OUTWARD     = "/\d[A-Za-z]{1,2}$/i";


    /**
     * Regular expression pattern for Inward code
     */
    private const REGEXP_INWARD      = "/\d[A-Za-z]{2}$/i";


    /**
     * Regular expression pattern for Area code
     */
    private const REGEXP_AREA        = "/^[A-Za-z]{1,2}/i";


    /**
     * Regular expression pattern for Sector code
     */
    private const REGEXP_SECTOR      = "/^[A-Za-z]{1,2}\d[A-Za-z\d]?\s*\d/i";


    /**
     * Regular expression pattern for Unit code
     */
    private const REGEXP_UNIT        =  "/[A-Za-z]{2}$/i";


    /**
     * Regular expression pattern for District code
     */
    private const REGEXP_DISTRICT    = "/^([A-Za-z]{1,2}\d)([A-Za-z])$/i";


    /**
     * Regular expression pattern for Subdistrict code
     */
    private const REGEXP_SUBDISTRICT = "/^([A-Za-z]{1,2}\d)([A-Za-z])$/i";


    /**
     * @var string $value
     */
    private string $value;


    /**
     * Constructor
     *
     * @param string $value  e.g. "AA9A 9AA"
     */
    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new Exception\InvalidArgumentException;
        }

        $this->value = $value;
    }


    /**
     * Normalise
     *
     * @return string  Example: "AA9A 9AA"
     */
    public function normalise(): string
    {
        return \strtoupper(sprintf("%s %s", $this->outward(), $this->inward()));
    }


    /**
     * Outward code
     *
     * The outward code is the part of the postcode before the single space in the middle.
     * It is between two and four characters long. A few outward codes are non-geographic,
     * not divulging where mail is to be sent. Examples of outward codes include "L1", "W1A",
     * "RH1", "RH10" or "SE1P".
     *
     * @return string Example: "AA9A"
     */
    public function outward(): string
    {
        return \trim(
            \preg_replace(self::REGEXP_OUTWARD, "", $this->value)
        );
    }


    /**
     * Backward compatibility with version 1.0
     *
     * @return string Example: "AA9A"
     */
    public function outcode(): string
    {
        return $this->outward();
    }


    /**
     * Inward code
     *
     * The inward part is the part of the postcode after the single space in the middle.
     * It is three characters long. The inward code assists in the delivery of post within
     * a postal district. Examples of inward codes include "0NY", "7GZ", "7HF", or "8JQ".
     *
     * @return string  Example: "9AA"
     */
    public function inward(): string
    {
        return (\preg_match(self::REGEXP_INWARD, $this->value, $matches)) ? $matches[0] : "";
    }


    /**
     * Backward compatibility with version 1.0
     *
     * @return string  Example: "9AA"
     */
    public function incode(): string
    {
        return $this->inward();
    }


    /**
     * Area code
     *
     * The postcode area is part of the outward code. The postcode area is either one or two
     * characters long and is all letters. Examples of postcode areas include "L" for Liverpool,
     * "RH" for Redhill and "EH" for Edinburgh. A postal area may cover a wide area, for example
     * "RH" covers north Sussex, and "BT" (Belfast) covers the whole of Northern Ireland.
     * There are 124 postcode areas in the UK.
     *
     * @return string  Example: "AA"
     */
    public function area(): string
    {
        return (\preg_match(self::REGEXP_AREA, $this->value, $matches)) ? $matches[0] : "";
    }


    /**
     * District code
     *
     * The postcode district is the outward code. It is made of the postcode area
     * plus one or two digits (and sometimes a final letter). The outward code is
     * between two and four characters long. Examples of postcode districts include
     * "W1A", "RH1", "RH10" or "SE1P".
     * There are approximately 2,900 postcode districts.
     *
     * @return string  Example: "AA9"
     */
    public function district(): string
    {
        return (\preg_match(self::REGEXP_DISTRICT, $this->outward(), $matches)) ? $matches[1] : "";
    }


    /**
     * Sector code
     *
     * The postcode sector is made up of the postcode district, the single space, and the
     * first character of the inward code. It is between four and six characters long
     * (including the single space). Examples of postcode sectors include "SW1W 0", "PO16 7",
     * "GU16 7", or "L1 8", "CV1 4". There are approximately 9,650 postcode sectors.
     *
     * @return string    Example: "AA9A 9"
     */
    public function sector(): string
    {
        return (\preg_match(self::REGEXP_SECTOR, $this->value, $matches)) ? $matches[0] : "";
    }


    /**
     * Unit code
     *
     * Identifies one or more small user delivery points or an individual large user.
     * There are approximately 1.71 million unit postcodes in the UK.
     *
     * @return string  Example: "AA"
     */
    public function unit(): string
    {
        return (\preg_match(self::REGEXP_UNIT, $this->value, $matches)) ? $matches[0] : "";
    }


    /**
     * Subdistrict code
     *
     * @return string  Example: "AA9A"
     */
    public function subdistrict(): string
    {
        return (\preg_match(self::REGEXP_SUBDISTRICT, $this->outward(), $matches)) ? $matches[0] : "";
    }


    /**
     * Returns true if the value is a valid UK postcode
     *
     * @param  string  $value
     * @return boolean
     */
    public static function isValid($value): bool
    {
        if (!\preg_match(self::REGEXP_POSTCODE, $value)) {
            return false;
        }
        return true;
    }


    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return Postcode
     */
    public static function fromNative(): Postcode
    {
        $value = func_get_arg(0);
        return new static($value);
    }


    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative(): string
    {
        return $this->value;
    }


    /**
     * Returns TRUE if this Postcode object equals to another.
     *
     * @param  Postcode $other
     * @return boolean
     */
    public function equals(Postcode $other): bool
    {
        return $this->compareTo($other) == 0;
    }


    /**
     * Compare two Postcode and tells whether they can be considered equal
     *
     * @param Postcode $other
     * @return bool
     *
     */
    public function compareTo(Postcode $other): bool
    {
        return (strcmp($this->toNative(), $other->toNative()) !== 0);
    }


    /**
     * Returns an array with postcode elements
     *
     * @return array
     */
    public function split(): array
    {
        return [
            'outward'     => $this->outward(),
            'inward'      => $this->inward(),
            'area'        => $this->area(),
            'district'    => $this->district(),
            'subdistrict' => $this->subdistrict(),
            'sector'      => $this->sector(),
            'unit'        => $this->unit(),
            'normalise'   => $this->normalise(),
        ];
    }


    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->normalise();
    }


    /**
     * Specify data which should be serialized to JSON
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * @link   http://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize(): mixed
    {
        return [
            'postcode' => (string) $this->normalise()
        ];
    }
}
