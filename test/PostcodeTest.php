<?php
namespace VasilDakov\Tests;

use VasilDakov\Postcode\PostcodeInterface;
use VasilDakov\Postcode\Postcode;

class PostcodeTest extends \PHPUnit_Framework_TestCase
{
    /** @var string $value */
    private $value;

    /** @var Postcode $postcode */
    private $postcode;


    public function setUp()
    {
        $this->value    = 'AA9A 9AA';
        $this->postcode = new Postcode($this->value);
    }


    public function testConstructorThrowsAnExceptions()
    {
        self::setExpectedException(\InvalidArgumentException::class);
        $this->postcode = new Postcode(1234.45);
    }


    public function testPostcodeCanBeConstructed()
    {
        $value      = 'AA9A 9AA';
        $postcode   = new Postcode($value);

        self::assertInstanceOf(Postcode::class, $postcode);

        //self::assertTrue($postcode->valid());
        //self::assertEquals($value, $postcode->toNative());
        //self::assertEquals($value, $postcode->normalise());
    }


    public function testGetCode()
    {
        $value = 'TW1 3QS';
        $postcode = new Postcode($value);

        self::assertEquals($value, $postcode->toNative());
    }


    public function testNormalize()
    {
        $value = 'TW13QS';
        $postcode = new Postcode($value);
        self::assertEquals('TW1 3QS', $postcode->normalise());
    }


    public function testSameValueAs()
    {
        $postcode1 = new Postcode('AA9A 9AA');
        $postcode2 = new Postcode('AA9A 9AA');

        $postcode3 = new Postcode('TW1 3QS');

        self::assertTrue($postcode1->equals($postcode2));
        self::assertTrue($postcode2->equals($postcode1));

        self::assertFalse($postcode1->equals($postcode3));
    }


    public function testOutward()
    {
        self::assertEquals('AA9A', $this->postcode->outward());
    }


    public function testInward()
    {
        self::assertEquals('9AA', $this->postcode->inward());
    }


    public function testArea()
    {
        self::assertEquals('AA', $this->postcode->area());
    }


    public function testDistrict()
    {
        self::assertEquals('AA9', $this->postcode->district());
    }


    public function testSubDistrict()
    {
        self::assertEquals('AA9A', $this->postcode->subdistrict());
    }


    public function testSector()
    {
        self::assertEquals('AA9A 9', $this->postcode->sector());
    }


    public function testUnit()
    {
        self::assertEquals('AA', $this->postcode->unit());
    }


    public function testFromNative()
    {
        $postcode = Postcode::fromNative('TW8 8FB');

        self::assertInstanceOf(Postcode::class, $postcode);
    }


    public function testToNative()
    {
        self::assertEquals($this->value, $this->postcode->toNative());
    }


    public function testIsValid()
    {
        /* $values = ['EC1V 9LB', 'EC1V9LB', 'TW8 8FB', 'TW88FB'];

        foreach ($values as $value) {
            $postcode = new Postcode($value);
            self::assertTrue($postcode->valid());
        } */
    }


    public function testToString()
    {
        $string = (string) $this->postcode;

        self::assertInternalType('string', $string);
        self::assertEquals($this->value, $string);
    }
}
