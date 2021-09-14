<?php

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\Song;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SongTest extends TestCase
{
    /** @test */
    public function it_can_create_song_object()
    {
        $song = new Song('Coldplay', 'Yellow');

        $this->assertInstanceOf(Song::class, $song);
        $this->assertSame('Coldplay', $song->getArtist());
        $this->assertSame('Yellow', $song->getTitle());
    }

    /** @test */
    public function it_will_throw_an_exception_if_artist_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Artist can't be empty.");

        new Song('', 'Yellow');
    }

    /** @test */
    public function it_will_throw_an_exception_if_title_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Title can't be empty.");

        new Song('Coldplay', '');
    }

    /** @test */
    public function it_can_validate_email_objects_are_the_same()
    {
        $songA = new Song('Coldplay', 'Yellow');
        $songB = new Song('Coldplay', 'Yellow');

        $this->assertTrue($songA->isSame($songB));
    }

    /** @test */
    public function it_can_validate_email_objects_arent_the_same()
    {
        $songA = new Song('Coldplay', 'Yellow');
        $songB = new Song('Metallica', 'One');

        $this->assertFalse($songA->isSame($songB));
    }
}
