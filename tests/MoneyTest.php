<?php

declare(strict_types=1);

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\Money;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MoneyTest extends TestCase
{
    /** @test */
    public function it_can_create_a_money_object()
    {
        $money = new Money(1000, 'DKK');

        $this->assertSame(1000, $money->getAmount());
        $this->assertSame('DKK', $money->getCurrency());
    }

    /** @test */
    public function it_will_throw_an_exception_if_currency_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Currency cannot be empty.');

        new Money(1000, '');
    }

    /** @test */
    public function it_can_validate_money_objects_are_the_same()
    {
        $moneyA = new Money(200, 'USD');
        $moneyB = new Money(200, 'USD');

        $this->assertTrue($moneyA->isSame($moneyB));
    }

    /** @test */
    public function it_can_validate_money_objects_arent_the_same()
    {
        $moneyA = new Money(200, 'USD');
        $moneyB = new Money(300, 'USD');

        $this->assertFalse($moneyA->isSame($moneyB));
    }
}