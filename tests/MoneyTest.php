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

        $this->assertInstanceOf(Money::class, $money);
        $this->assertSame(1000, $money->getAmount());
        $this->assertSame('DKK', $money->getCurrency());
    }

    /** @test */
    public function it_can_get_amount_as_float()
    {
        $money = new Money(125, 'USD');

        $this->assertInstanceOf(Money::class, $money);
        $this->assertSame(1.25, $money->getAmountAsFloat());
    }

    /** @test */
    public function it_can_validate_that_two_money_objects_has_the_same_currency()
    {
        $moneyA = new Money(1100, 'DKK');
        $moneyB = new Money(3300, 'DKK');

        $this->assertTrue($moneyA->hasSameCurrency($moneyB));
    }

    /** @test */
    public function it_can_validate_that_two_money_objects_doesnt_have_the_same_currency()
    {
        $moneyA = new Money(3100, 'DKK');
        $moneyB = new Money(1300, 'EUR');

        $this->assertFalse($moneyA->hasSameCurrency($moneyB));
    }

    /** @test */
    public function it_will_throw_an_exception_if_currency_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Currency cannot be empty.');

        new Money(1000, '');
    }

    /** @test */
    public function it_can_add_two_money_objects_with_the_same_currency_together()
    {
        $moneyA = new Money(1000, 'DKK');
        $moneyB = new Money(3400, 'DKK');
        $moneyC = $moneyA->add($moneyB);

        $this->assertInstanceOf(Money::class, $moneyC);
        $this->assertSame(4400, $moneyC->getAmount());
        $this->assertSame('DKK', $moneyC->getCurrency());
    }

    /** @test */
    public function it_can_subtract_two_money_objects_with_the_same_currency_together()
    {
        $moneyA = new Money(3000, 'DKK');
        $moneyB = new Money(1400, 'DKK');
        $moneyC = $moneyA->subtract($moneyB);

        $this->assertInstanceOf(Money::class, $moneyC);
        $this->assertSame(1600, $moneyC->getAmount());
        $this->assertSame('DKK', $moneyC->getCurrency());
    }

    /** @test */
    public function it_will_throw_an_error_if_adding_money_objects_with_different_currencies()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('You can only add values with the same currency.');

        $moneyA = new Money(3200, 'DKK');
        $moneyB = new Money(6700, 'EUR');
        $moneyA->add($moneyB);
    }

    /** @test */
    public function it_will_throw_an_error_if_subtracting_money_objects_with_different_currencies()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('You can only subtract values with the same currency.');

        $moneyA = new Money(3300, 'DKK');
        $moneyB = new Money(700, 'EUR');
        $moneyA->subtract($moneyB);
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