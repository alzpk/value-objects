<?php

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\Email;
use Alzpk\ValueObjets\ValueObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /** @test */
    public function it_can_create_an_email_object()
    {
        $email = new Email('test@example.com');

        $this->assertInstanceOf(ValueObject::class, $email);
        $this->assertSame('test@example.com', $email->getEmail());
    }

    /** @test */
    public function it_will_throw_an_exception_if_email_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Email is not valid.');

        new Email('test@example');
    }

    /** @test */
    public function it_can_validate_email_objects_are_the_same()
    {
        $emailA = new Email('test@example.com');
        $emailB = new Email('test@example.com');

        $this->assertTrue($emailA->isSame($emailB));
    }

    /** @test */
    public function it_can_validate_email_objects_arent_the_same()
    {
        $emailA = new Email('test@example.com');
        $emailB = new Email('nope@example.com');

        $this->assertFalse($emailA->isSame($emailB));
    }
}
