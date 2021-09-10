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

    /**
     * Returns email as string
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Returns true/false, based on a complete match of the two objects
     *
     * @param Email $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->email === $object->getEmail();
    }
}