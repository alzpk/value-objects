<?php

namespace Alzpk\ValueObjets;

use InvalidArgumentException;

class Movie implements ValueObject
{
    private string $title;
    private string $director;
    private int $year;
    private string $plot;
    private string $trailerUrl;
    private float $rating;

    public function __construct(string $title, string $director, int $year,
                                string $plot, string $trailerUrl, float $rating)
    {
        if ($title === '') {
            throw new InvalidArgumentException("Title can't be empty.");
        }

        if ($director === '') {
            throw new InvalidArgumentException("Director can't be empty.");
        }

        if (strlen($year) != 4) {
            throw new InvalidArgumentException("Year isn't valid.");
        }

        if ($plot === '') {
            throw new InvalidArgumentException("Plot can't be empty.");
        }

        if (!filter_var($trailerUrl, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED)) {
            throw new InvalidArgumentException("Invalid trailer URL.");
        }

        if ($rating < 0 || $rating > 10) {
            throw new InvalidArgumentException('Rating should be between 0 and 10.');
        }

        $this->title = $title;
        $this->director = $director;
        $this->year = $year;
        $this->plot = $plot;
        $this->trailerUrl = $trailerUrl;
        $this->rating = $rating;
    }

    /**
     * Get title as string
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get director as string
     *
     * @return string
     */
    public function getDirector(): string
    {
        return $this->director;
    }

    /**
     * Get year as integer
     *
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * Get plot as string
     *
     * @return string
     */
    public function getPlot(): string
    {
        return $this->plot;
    }

    /**
     * Get trailer url as string
     *
     * @return string
     */
    public function getTrailerUrl(): string
    {
        return $this->trailerUrl;
    }

    /**
     * Get rating as float
     *
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * Returns true/false, based on a complete match of the two objects
     *
     * @param Movie $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        return $this->title === $object->getTitle()
            && $this->director === $object->getDirector()
            && $this->year === $object->getYear()
            && $this->plot === $object->getPlot()
            && $this->trailerUrl === $object->getTrailerUrl()
            && $this->rating === $object->getRating();
    }
}