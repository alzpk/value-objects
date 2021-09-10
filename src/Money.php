<?php

declare(strict_types=1);

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

final class Money implements ValueObject
{
    private int $amount;
    private string $currency;

    public function __construct(int $amount, string $currency)
    {
        if ($currency === '') {
            throw new InvalidArgumentException('Currency cannot be empty.');
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function hasSameCurrency(Money $money): bool
    {
        return $this->currency === $money->getCurrency();
    }

    public function add(Money $money): self
    {
        if (!$this->hasSameCurrency($money)) {
            throw new InvalidArgumentException('You can only add values with the same currency.');
        }

        return new self($this->amount + $money->getAmount(), $this->currency);
    }

    public function subtract(Money $money): self
    {
        if (!$this->hasSameCurrency($money)) {
            throw new InvalidArgumentException('You can only subtract values with the same currency.');
        }

        return new self($this->amount - $money->getAmount(), $this->currency);
    }

    /**
     * @param Money $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->currency === $object->getCurrency()
            && $this->amount === $object->getAmount();
    }
}