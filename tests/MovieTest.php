<?php

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\Movie;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    /** @test */
    public function it_can_create_a_movie_object()
    {
        $movie = new Movie(
            'Star Wars',
            'George Lucas',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );

        $this->assertInstanceOf(Movie::class, $movie);
        $this->assertSame('Star Wars', $movie->getTitle());
        $this->assertSame('George Lucas', $movie->getDirector());
        $this->assertSame(1977, $movie->getYear());
        $this->assertSame('Luke Skywalker joins forces with a Jedi Knight...', $movie->getPlot());
        $this->assertSame('https://www.imdb.com/video/vi1317709849?playlistId=tt0076759', $movie->getTrailerUrl());
        $this->assertSame(8.6, $movie->getRating());
    }

    /** @test */
    public function it_will_throw_an_exception_if_title_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Title can't be empty.");

        new Movie(
            '',
            'George Lucas',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_director_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Director can't be empty.");

        new Movie(
            'Star Wars',
            '',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_year_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Year isn't valid.");

        new Movie(
            'Star Wars',
            'George Lucas',
            197,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_plot_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Plot can't be empty.");

        new Movie(
            'Star Wars',
            'George Lucas',
            1977,
            '',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_trailer_url_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid trailer URL.");

        new Movie(
            'Star Wars',
            'George Lucas',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/',
            8.6
        );
    }

    /** @test */
    public function it_will_throw_an_exception_if_rating_is_out_of_range()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Rating should be between 0 and 10.");

        new Movie(
            'Star Wars',
            'George Lucas',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            11.2
        );
    }

    /** @test */
    public function it_can_validate_email_objects_are_the_same()
    {
        $nameA = new Movie(
            'Star Wars',
            'George Lucas',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );
        $nameB = new Movie(
            'Star Wars',
            'George Lucas',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );

        $this->assertTrue($nameA->isSame($nameB));
    }

    /** @test */
    public function it_can_validate_email_objects_arent_the_same()
    {
        $nameA = new Movie(
            'Star Wars',
            'George Lucas',
            1977,
            'Luke Skywalker joins forces with a Jedi Knight...',
            'https://www.imdb.com/video/vi1317709849?playlistId=tt0076759',
            8.6
        );
        $nameB = new Movie(
            'The Lord of the Rings: The Fellowship of the Ring',
            'Peter Jackson',
            2001,
            'A meek Hobbit from the Shire and eight...',
            'https://www.imdb.com/video/vi2073101337?playlistId=tt0120737',
            8.8
        );;

        $this->assertFalse($nameA->isSame($nameB));
    }
}
