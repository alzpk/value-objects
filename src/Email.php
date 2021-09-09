<?php

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

class Email implements ValueObject
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email is not valid.');
        }

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param Email $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->email === $object->getEmail();
    }
}