<?php 
namespace VasilDakov\Postcode\Entity;

class Postcode
{
	/**
	 * @param String     $code
	 * @param Coordinate $coordinate
	 */
    public function __construct(String $code, Coordinate $coordinate)
    {
        $this->postcode   = $postcode;
        $this->coordinate = $coordinate;
    }
}
