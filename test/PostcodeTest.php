<?php
namespace VasilDakov\Tests;

use VasilDakov\Postcode\Postcode;

use ValueObjects\String\String;


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
        self::setExpectedException('InvalidArgumentException');
        $this->postcode = new Postcode(1234.45);
    }

    public function testPostcodeCanBeConstructed()
    {
        $value      = 'AA9A 9AA';
        $postcode   = new Postcode($value);

        self::assertInstanceOf(Postcode::class, $postcode);

        self::assertTrue($postcode->valid());

        self::assertEquals($value, $postcode->toNative());
        self::assertEquals($value, $postcode->normalise());
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

        self::assertNull((new Postcode('ABC'))->normalise());
    }


    public function testSameValueAs()
    {
        $postcode1 = new Postcode('AA9A 9AA');
        $postcode2 = new Postcode('AA9A 9AA');

        $postcode3 = new Postcode('TW1 3QS');

        self::assertTrue($postcode1->sameValueAs($postcode2));
        self::assertTrue($postcode2->sameValueAs($postcode1));

        self::assertFalse($postcode1->sameValueAs($postcode3));

        /** @var \PHPUnit_Framework_MockObject_MockObject|\ValueObjects\ValueObjectInterface $mock */
        $mock = $this->getMockBuilder(\ValueObjects\ValueObjectInterface::class)
            ->setMethods(array())
            ->getMockForAbstractClass()
        ;

        self::assertFalse($postcode1->sameValueAs($mock));
    }


    public function testOutcode()
    {
        self::assertEquals('AA9A', $this->postcode->outcode());
        self::assertNull((new Postcode('ABC'))->outcode());
    }


    public function testIncode()
    {
        self::assertEquals('9AA', $this->postcode->incode());
        self::assertNull((new Postcode('ABC'))->incode());
    }

    public function testArea()
    {
        self::assertEquals('AA', $this->postcode->area());
        self::assertNull((new Postcode('ABC'))->area());
    }

    public function testDistrict()
    {
        self::assertEquals('AA9', $this->postcode->district());
        self::assertNull((new Postcode('ABC'))->district());
    }

    public function testSubDistrict()
    {
        self::assertEquals('AA9A', $this->postcode->subdistrict());
        self::assertNull((new Postcode('ABC'))->subdistrict());
    }

    public function testSector()
    {
        self::assertEquals('AA9A 9', $this->postcode->sector());
        self::assertNull((new Postcode('ABC'))->sector());
    }

    public function testUnit()
    {
        self::assertEquals('AA', $this->postcode->unit());
        self::assertNull((new Postcode('ABC'))->unit());
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
        $values = ['EC1V 9LB', 'EC1V9LB', 'TW8 8FB', 'TW88FB'];

        foreach ($values as $value) {
            $postcode = new Postcode($value);
            self::assertTrue($postcode->valid());
        }
    }


    public function testToString() 
    {
        $string = $this->postcode->__toString();

        self::assertInternalType('string', $string);
        self::assertEquals($this->value, $string);
    }
}
