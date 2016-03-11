<?php
namespace VasilDakov\Tests\ValueObject;

use VasilDakov\Postcode\ValueObject\Postcode;

use ValueObjects\String\String;


class PostcodeTest extends \PHPUnit_Framework_TestCase
{
	/** @var String $code */
	private $code;

	/** @var Postcode $postcode */
	private $postcode;

    public function setUp()
    {
    	$this->value    = 'AA9A 9AA';
    	$this->code     = new String($this->value);
    	$this->postcode = new Postcode($this->code);
    }


    public function testPostcodeCanBeConstructed()
    {
    	$value      = 'AA9A 9AA';
        $code       = new String($value);
        $postcode   = new Postcode($code);

        self::assertInstanceOf(String::class, $code);
        self::assertInstanceOf(Postcode::class, $postcode);

        self::assertTrue($postcode->valid());

        self::assertEquals($value, $postcode->getCode()->toNative());
        self::assertEquals($value, $postcode->normalise());
	}


    public function testGetCode()
    {
        $value = 'TW1 3QS';
        $postcode = new Postcode(new String($value));

        self::assertInstanceOf(String::class, $postcode->getCode());
        self::assertEquals($value, $postcode->getCode()->toNative());
    }


	public function testNormalize()
	{
		$value = 'TW13QS';
		$postcode = new Postcode(new String($value));
		self::assertEquals('TW1 3QS', $postcode->normalise());
	}


    public function testSameValueAs()
	{
        $code = new String('AA9A 9AA');
        
        $postcode1 = new Postcode($code);
        $postcode2 = new Postcode($code);

        $postcode3 = new Postcode(new String('TW1 3QS'));

        self::assertTrue($postcode1->sameValueAs($postcode2));
        self::assertTrue($postcode2->sameValueAs($postcode1));

        self::assertFalse($postcode1->sameValueAs($postcode3));
    }


    public function testOutcode()
    {
        self::assertEquals('AA9A', $this->postcode->outcode());
    }


    public function testIncode()
    {
    	self::assertEquals('9AA', $this->postcode->incode());
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
        self::assertEquals('AA9A', $this->postcode->subDistrict());
    }

    public function testSector()
    {
        self::assertEquals('AA9A 9', $this->postcode->sector());
    }

    public function testUnit()
    {
        self::assertEquals('AA', $this->postcode->unit());
	}


    public function testIsValid()
    {
        $codes = ['EC1V 9LB', 'EC1V9LB', 'TW8 8FB', 'TW88FB'];

        foreach ($codes as $code) {
            $postcode = new Postcode(new String($code));
            self::assertTrue($postcode->valid());
        }
    }
}
