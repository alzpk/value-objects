<?php

declare(strict_types=1);

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

final class Money implements ValueObject
{
    private int $amount;
    private string $currency;

    /**
     * @param int $amount - Amount should be passed in minor units (eg. 1.00$ = 100)
     * @param string $currency
     */
    public function __construct(int $amount, string $currency)
    {
        if ($currency === '') {
            throw new InvalidArgumentException('Currency cannot be empty.');
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Returns the amount as integer
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Returns the amount as float
     *
     * @return float
     */
    public function getAmountAsFloat(): float
    {
        return $this->amount / 100;
    }

    /**
     * Returns the currency as string
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Returns true/false, based on a matching of currencies
     *
     * @param Money $money
     * @return bool
     */
    public function hasSameCurrency(Money $money): bool
    {
        return $this->currency === $money->getCurrency();
    }

    /**
     * Add money objects amount to another, if they have the same currency
     * Returns new money object with the summed amount
     *
     * @param Money $money
     * @return $this
     */
    public function add(Money $money): self
    {
        if (!$this->hasSameCurrency($money)) {
            throw new InvalidArgumentException('You can only add values with the same currency.');
        }

        return new self($this->amount + $money->getAmount(), $this->currency);
    }

    /**
     * Subtract money objects amount from another, if they have the same currency
     * Returns new money object with the summed amount
     *
     * @param Money $money
     * @return $this
     */
    public function subtract(Money $money): self
    {
        if (!$this->hasSameCurrency($money)) {
            throw new InvalidArgumentException('You can only subtract values with the same currency.');
        }

        return new self($this->amount - $money->getAmount(), $this->currency);
    }

    /**
     * Returns true/false, based on a complete match of the two objects
     *
     * @param Money $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->currency === $object->getCurrency()
            && $this->amount === $object->getAmount();
    }
}