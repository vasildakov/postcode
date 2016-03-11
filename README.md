# Postcode

[Value Object](http://martinfowler.com/bliki/ValueObject.html) that represents a UK postcode

## Installation

Here is a minimal example of a `composer.json` file that just defines a dependency on Postcode:

    {
        "require": {
            "vasildakov/postcode": "1.0.*"
        }
    }

## Usage Examples

#### Creating a Money object and accessing its monetary value

```php
use VasilDakov\Postcode\Postcode;

// Create Postcode with Location
$postcode = new Postcode('EC1V 9LB');

// Validate Postcode value
print $postcode->valid();

```

#### Perform simple validations, parsing and normalisation

```php
$postcode->valid()        // => true
$postcode->normalise()    // => "EC1V 9LB"

$postcode->outcode()      // => "EC1V"
$postcode->incode()       // => "9LB"
$postcode->area()         // => "EC"
$postcode->district()     // => "EC1"
$postcode->subDistrict()  // => "EC1V"
$postcode->sector()       // => "EC1V 9"
$postcode->unit()         // => "LB"

```

## Note on Postcode Validation

Postcodes cannot be validated just with a regular expression. Proper postcode validation requires having a full list of postcodes to check against. Relying on a regex will produce false postives/negatives.

A complete list of Postcodes can be obtained from the ONS Postcode Directory, which is updated every 3 months.