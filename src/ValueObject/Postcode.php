<?php 
namespace VasilDakov\Postcode\ValueObject;

use ValueObjects\ValueObjectInterface;
use ValueObjects\String\String;

class Postcode implements ValueObjectInterface 
{
	/**
	 * @param String     $code
	 * @param Coordinate $coordinate
	 */
    public function __construct(String $code)
    {
        $this->code = $code;
    }


    /**
     * @return String $code
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * @return boolean // => true
     */
    public function valid()
    {
        return (boolean) \preg_match("/^[a-z]{1,2}\d[a-z\d]?\s*\d[a-z]{2}$/i", $this->code);
    }


    /**
     * @return string // => "AA9A 9AA"
     */
    public function normalise()
    {
        if ($this->valid()) {
            return \strtoupper(\sprintf("%s %s", $this->outcode(), $this->incode()));
        }
        return null;
        
    }

    /**
     * The outward code is the part of the postcode before 
     * the single space in the middle. It is between two 
     * and four characters long. A few outward codes are 
     * non-geographic, not divulging where mail is to be 
     * sent. Examples of outward codes include "L1", "W1A", 
     * "RH1", "RH10" or "SE1P".
     * 
     * @return string // => "AA9A"
     */
    public function outcode()
    {
        if ($this->valid()) { 
            return \trim(\preg_replace("/\d[a-z]{2}$/i", "", $this->code));
        }
        return null;
    }


    /**
     * The inward part is the part of the postcode after the 
     * single space in the middle. It is three characters long. 
     * The inward code assists in the delivery of post within 
     * a postal district. Examples of inward codes include 
     * "0NY", "7GZ", "7HF", or "8JQ".
     * 
     * @return string // => "9AA"
     */
    public function incode()
    {
        if ($this->valid()) { 
            \preg_match("/\d[a-z]{2}$/i", $this->code, $matches);
            return $matches[0];
        }
        return null;
    }


    /**
     * The postcode area is part of the outward code. The postcode 
     * area is between one and two characters long and is all letters. 
     * Examples of postcode areas include "L" for Liverpool, "RH" for 
     * Redhill and "EH" Edinburgh. A postal area may cover a wide area, 
     * for example "RH" covers north Sussex, (which has little to do 
     * with Redhill historically apart from the railway links), and 
     * "BT" (Belfast) covers the whole of Northern Ireland.
     * 
     * @return string // => "AA"
     */
    public function area()
    {
        if ($this->valid()) { 
            \preg_match("/^[a-z]{1,2}/i", $this->code, $matches);
            return $matches[0];
        }
        return null;
    }

    /**
     * The district code is part of the outward code. It is between two and four 
     * characters long. It does not include the trailing letter found in some 
     * outcodes. Examples of district codes include "L1", "W1", "RH1", "RH10" or "SE1".
     * 
     * @return string // => "AA9"
     */
    public function district()
    {
        if ($this->valid()) { 
            \preg_match("/^([a-z]{1,2}\d)([a-z])$/i", $this->outcode(), $matches);
            return $matches[1];
        }
        return null;
    }

    /**
     * The sub-district code is part of the outward code. It is often not present, 
     * only existing in particularly high density London districts. It is between 
     * three and four characters long. It does include the trailing letter omitted 
     * from the district. Examples of sub-district codes include "W1A", "EC1A", 
     * "NW1W", "E1W" or "SE1P".
     * 
     * @return string // => "AA9A"
     */
    public function subDistrict()
    {
        if ($this->valid()) { 
            \preg_match("/^([a-z]{1,2}\d)([a-z])$/i", $this->outcode(), $matches);
            return $matches[0];
        }
        return null;
    }   

    /**
     * The postcode sector is made up of the postcode district, the single space, 
     * and the first character of the inward code. It is between four and six 
     * characters long (including the single space). Examples of postcode sectors 
     * include "SW1W 0", "PO16 7", "GU16 7", or "L1 8", "CV1 4".
     * 
     * @return string // => "AA9A 9"
     */
    public function sector()
    {
        if ($this->valid()) {
            \preg_match("/^[a-z]{1,2}\d[a-z\d]?\s*\d/i", $this->code, $matches);
            return $matches[0];
        }
        return null;
    }


    /**
     * The postcode unit is two characters added to the end of the postcode sector. 
     * Each postcode unit generally represents a street, part of a street, a single 
     * address, a group of properties, a single property, a sub-section of the property, 
     * an individual organisation or a subsection of the organisation.
     * 
     * @return string // => "AA"
     */
    public function unit()
    {
        if ($this->valid()) {
            \preg_match("/[a-z]{2}$/i", $this->code, $matches);
            return $matches[0];
        }
        return null;
    }


    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return ValueObjectInterface
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);

        return new static($value);
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->value;
    }


    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object)
    {
        if(\get_class($this) !== \get_class($object)) {
            return false;
        }

        return $this->getCode()->sameValueAs($object->getCode());
    }


    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString()
    {
    	return \sprintf('%s', $this->getCode());
    }
}
