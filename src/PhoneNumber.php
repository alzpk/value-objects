<?php

namespace Alzpk\ValueObjets;

class PhoneNumber implements ValueObject
{
    private int $countryCode;
    private int $nationalNumber;

    public function __construct(int $countryCode, int $nationalNumber)
    {
        $this->countryCode = $countryCode;
        $this->nationalNumber = $nationalNumber;
    }

    /**
     * Returns the country code as integer
     *
     * @return int
     */
    public function getCountryCode(): int
    {
        return $this->countryCode;
    }

    /**
     * Returns the national number as integer
     *
     * @return int
     */
    public function getNationalNumber(): int
    {
        return $this->nationalNumber;
    }

    /**
     * Returns a E164 formatted string of the phone number
     *
     * @return string
     */
    public function getPhoneNumberAsE164FormattedString(): string
    {
        return vsprintf('+%s%s', [
            $this->countryCode,
            $this->nationalNumber
        ]);
    }

    /**
     * Returns true/false, based on a complete match of the two objects
     *
     * @param PhoneNumber $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->countryCode === $object->getCountryCode()
            && $this->nationalNumber === $object->getNationalNumber();
    }
}