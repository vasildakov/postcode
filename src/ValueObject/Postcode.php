<?php 
namespace VasilDakov\Postcode\ValueObject;

use ValueObjects\ValueObjectInterface;
use ValueObjects\String\String;

class Postcode implements ValueObjectInterface 
{
    /**
     * @var String     $code
     */
    private $code;


    /**
     * @param String     $code
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
     * @return boolean  Example: true
     */
    public function valid()
    {
        return (boolean) \preg_match("/^[a-z]{1,2}\d[a-z\d]?\s*\d[a-z]{2}$/i", $this->code);
    }


    /**
     * @return string  Example: "AA9A 9AA"
     */
    public function normalise()
    {
        if ($this->valid()) {
            return \strtoupper(\sprintf("%s %s", $this->outcode(), $this->incode()));
        }
        return null;
        
    }

    /**
     * @return string Example: "AA9A"
     */
    public function outcode()
    {
        if ($this->valid()) { 
            return \trim(\preg_replace("/\d[a-z]{2}$/i", "", $this->code));
        }
        return null;
    }


    /**
     * @return string  Example: "9AA"
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
     * @return string  Example: "AA"
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
     * @return string  Example: "AA9"
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
     * @return string  Example: "AA9A"
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
     * @return string    Example: "AA9A 9"
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
     * @return string  Example: "AA"
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

        return new static(new String($value));
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->code->toNative();
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
