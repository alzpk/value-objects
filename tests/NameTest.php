<?php

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\Name;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /** @test */
    public function it_can_create_an_name_object()
    {
        $email = new Name('John', 'Doe');

        $this->assertInstanceOf(Name::class, $email);
        $this->assertSame('John', $email->getFirstname());
        $this->assertSame('Doe', $email->getLastname());
    }

    /** @test */
    public function it_can_get_full_name_from_name_object()
    {
        $email = new Name('John', 'Doe');

        $this->assertInstanceOf(Name::class, $email);
        $this->assertSame('John Doe', $email->getFullName());
    }

    /** @test */
    public function it_will_throw_an_exception_if_firstname_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Firstname can't be empty.");

        new Name('', 'Doe');
    }

    /** @test */
    public function it_will_throw_an_exception_if_lastname_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Lastname can't be empty.");

        new Name('John', '');
    }

    /** @test */
    public function it_can_validate_email_objects_are_the_same()
    {
        $nameA = new Name('John', 'Doe');
        $nameB = new Name('John', 'Doe');

        $this->assertTrue($nameA->isSame($nameB));
    }

    /** @test */
    public function it_can_validate_email_objects_arent_the_same()
    {
        $nameA = new Name('John', 'Doe');
        $nameB = new Name('Ben', 'Johnson');

        $this->assertFalse($nameA->isSame($nameB));
    }
}
