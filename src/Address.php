<?php

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

class Address implements ValueObject
{
    private string $street;
    private string $houseNumber;
    private string $city;
    private string $zip;
    private string $region;
    private string $country;

    public function __construct(string $street, string $houseNumber, string $city, string $zip, string $region, string $country)
    {
        if ($street === '') {
            throw new InvalidArgumentException('Street cannot be empty.');
        }

        if ($houseNumber === '') {
            throw new InvalidArgumentException('House number cannot be empty.');
        }

        if ($city === '') {
            throw new InvalidArgumentException('City cannot be empty.');
        }

        if ($zip === '') {
            throw new InvalidArgumentException('Zip cannot be empty.');
        }

        if ($country === '') {
            throw new InvalidArgumentException('Country cannot be empty.');
        }

        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->city = $city;
        $this->zip = $zip;
        $this->region = $region;
        $this->country = $country;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @param Address $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->street === $object->getStreet()
            && $this->houseNumber === $object->getHouseNumber()
            && $this->city === $object->getCity()
            && $this->zip === $object->getZip()
            && $this->region === $object->getRegion()
            && $this->country === $object->getCountry();
    }
}