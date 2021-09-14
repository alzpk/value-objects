<?php

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

class Song implements ValueObject
{
    private string $artist;
    private string $title;

    public function __construct(string $artist, string $title)
    {
        if ($artist === '') {
            throw new InvalidArgumentException("Artist can't be empty.");
        }

        if ($title === '') {
            throw new InvalidArgumentException("Title can't be empty.");
        }

        $this->artist = $artist;
        $this->title = $title;
    }

    /**
     * Returns artist as string
     *
     * @return string
     */
    public function getArtist(): string
    {
        return $this->artist;
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
     * Returns true/false, based on a complete match of the two objects
     *
     * @param Song $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->artist === $object->getArtist()
            && $this->title === $object->getTitle();
    }
}