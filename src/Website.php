<?php

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

class Website implements ValueObject
{
    private string $title;
    private string $domain;

    public function __construct(string $title, string $domain)
    {
        if ($title === '') {
            throw new InvalidArgumentException("Title can't be empty.");
        }

        if (!filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new InvalidArgumentException('Domain is not valid.');
        }

        $this->title = $title;
        $this->domain = $domain;
    }

    /**
     * Returns title as string
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Return domain as string
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Returns a non-secure url as string
     *
     * @return string
     */
    public function getUrl(): string
    {
        return vsprintf('http://%s/', [$this->domain]);
    }

    /**
     * Returns a secure url as string
     *
     * @return string
     */
    public function getSecureUrl(): string
    {
        return vsprintf('https://%s/', [$this->domain]);
    }

    /**
     * Returns true/false, based on a complete match of the two objects
     *
     * @param Website $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->title === $object->getTitle()
            && $this->domain === $object->getDomain();
    }
}