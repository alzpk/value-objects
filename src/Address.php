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

    /**
     * Returns street as string
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Returns city as string
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Returns zip as string
     *
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * Returns region as string
     *
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * Returns country as string
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Returns house number as string
     *
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * Returns true/false, based on a complete match of the two objects
     *
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