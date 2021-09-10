<?php

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\Address;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /** @test */
    public function it_can_create_an_address_object()
    {
        $address = new Address(
            'Testvej',
            '1337',
            'Esbjerg',
            '6710',
            'Syddanmark',
            'Danmark'
        );

        $this->assertInstanceOf(Address::class, $address);
        $this->assertSame('Testvej', $address->getStreet());
        $this->assertSame('1337', $address->getHouseNumber());
        $this->assertSame('Esbjerg', $address->getCity());
        $this->assertSame('6710', $address->getZip());
        $this->assertSame('Syddanmark', $address->getRegion());
        $this->assertSame('Danmark', $address->getCountry());
    }

    /** @test */
    public function it_can_create_address_object_with_empty_region()
    {
        $address = new Address(
            'Testvej',
            '1337',
            'Esbjerg',
            '6710',
            '',
            'Danmark'
        );

        $this->assertInstanceOf(Address::class, $address);
        $this->assertSame('Testvej', $address->getStreet());
        $this->assertSame('1337', $address->getHouseNumber());
        $this->assertSame('Esbjerg', $address->getCity());
        $this->assertSame('6710', $address->getZip());
        $this->assertSame('', $address->getRegion());
        $this->assertSame('Danmark', $address->getCountry());
    }

    /** @test */
    public function it_will_throw_an_exception_if_street_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Street cannot be empty.');

        new Address(
            '',
            '1337',
            'Esbjerg',
            '6710',
            'Syddanmark',
            'Danmark'
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_house_number_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('House number cannot be empty.');

        new Address(
            'Testvej',
            '',
            'Esbjerg',
            '6710',
            'Syddanmark',
            'Danmark'
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_city_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('City cannot be empty.');

        new Address(
            'Testvej',
            '1337',
            '',
            '6710',
            'Syddanmark',
            'Danmark'
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_zip_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Zip cannot be empty.');

        new Address(
            'Testvej',
            '1337',
            'Esbjerg',
            '',
            'Syddanmark',
            'Danmark'
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_country_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Country cannot be empty.');

        new Address(
            'Testvej',
            '1337',
            'Esbjerg',
            '6710',
            'Syddanmark',
            ''
        );
    }

    /** @test */
    public function it_can_validate_address_objects_are_the_same()
    {
        $addressA = new Address(
            'Testvej',
            '1337',
            'Esbjerg',
            '6710',
            'Syddanmark',
            'Danmark'
        );
        $addressB = new Address(
            'Testvej',
            '1337',
            'Esbjerg',
            '6710',
            'Syddanmark',
            'Danmark'
        );

        $this->assertTrue($addressA->isSame($addressB));
    }

    /** @test */
    public function it_can_validate_address_objects_arent_the_same()
    {
        $addressA = new Address(
            'Testvej',
            '1337',
            'Esbjerg',
            '6710',
            'Syddanmark',
            'Danmark'
        );
        $addressB = new Address(
            'Testvej',
            '1338',
            'Esbjerg',
            '6710',
            'Syddanmark',
            'Danmark'
        );

        $this->assertFalse($addressA->isSame($addressB));
    }
}
