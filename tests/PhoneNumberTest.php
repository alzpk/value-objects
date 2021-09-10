<?php

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\PhoneNumber;
use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    /** @test */
    public function it_can_create_a_phone_number_object()
    {
        $phoneNumber = new PhoneNumber(45, 12345678);

        $this->assertInstanceOf(PhoneNumber::class, $phoneNumber);
        $this->assertSame(45, $phoneNumber->getCountryCode());
        $this->assertSame(12345678, $phoneNumber->getNationalNumber());
    }

    /** @test */
    public function it_can_validate_phone_number_objects_are_the_same()
    {
        $phoneNumberA = new PhoneNumber(45, 12345678);
        $phoneNumberB = new PhoneNumber(45, 12345678);

        $this->assertTrue($phoneNumberA->isSame($phoneNumberB));
    }

    /** @test */
    public function it_can_get_an_e164_formatted_string_of_the_phone_number()
    {
        $phoneNumber = new PhoneNumber(45, 12345678);

        $this->assertInstanceOf(PhoneNumber::class, $phoneNumber);
        $this->assertSame('+4512345678', $phoneNumber->getPhoneNumberAsE164FormattedString());
    }
}
