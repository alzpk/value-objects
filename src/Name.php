<?php

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

class Name implements ValueObject
{
    private $firstname;
    private $lastname;

    public function __construct(string $firstname, string $lastname)
    {
        if ($firstname === '') {
            throw new InvalidArgumentException("Firstname can't be empty.");
        }

        if ($lastname === '') {
            throw new InvalidArgumentException("Lastname can't be empty.");
        }

        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * Returns firstname as a string
     *
     * @return mixed
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Returns lastname as a string
     *
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Returns a combination of first and lastname.
     *
     * @return string
     */
    public function getFullName(): string
    {
        return vsprintf('%s %s', [
            $this->firstname,
            $this->lastname
        ]);
    }

    /**
     * Returns true/false, based on a complete match of the two objects
     *
     * @param Name $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->firstname === $object->getFirstname()
            && $this->lastname === $object->getLastname();
    }
}