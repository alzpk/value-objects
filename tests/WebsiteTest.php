<?php

namespace Alzpk\ValueObjets\Tests;

use Alzpk\ValueObjets\Website;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class WebsiteTest extends TestCase
{
    /** @test */
    public function it_can_create_an_website_object()
    {
        $website = new Website('Google Search Engine', 'google.com');

        $this->assertInstanceOf(Website::class, $website);
        $this->assertSame('Google Search Engine', $website->getTitle());
        $this->assertSame('google.com', $website->getDomain());
    }

    /** @test */
    public function it_can_get_url_from_website_object()
    {
        $website = new Website('Google Search Engine', 'google.com');

        $this->assertSame('http://google.com/', $website->getUrl());
    }

    /** @test */
    public function it_can_get_secure_url_from_website_object()
    {
        $website = new Website('Google Search Engine', 'google.com');

        $this->assertSame('https://google.com/', $website->getSecureUrl());
    }

    /** @test */
    public function it_will_throw_an_exception_if_title_is_empty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Title can't be empty.");

        new Website('', 'google.com');
    }

    /** @test */
    public function it_will_throw_an_exception_if_domain_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Domain is not valid.");

        new Website('Google Search Engine', 'google. com');
    }

    /** @test */
    public function it_can_validate_domain_objects_are_the_same()
    {
        $websiteA = new Website('Google Search Engine', 'google.com');
        $websiteB = new Website('Google Search Engine', 'google.com');

        $this->assertTrue($websiteA->isSame($websiteB));
    }

    /** @test */
    public function it_can_validate_domain_objects_arent_the_same()
    {
        $websiteA = new Website('Google Search Engine', 'google.com');
        $websiteB = new Website('Yahoo Search Engine', 'yahoo.com');

        $this->assertFalse($websiteA->isSame($websiteB));
    }
}
