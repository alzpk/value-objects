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

    /**
     * @param Money $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->currency === $object->currency
            && $this->amount === $object->amount;
    }
}