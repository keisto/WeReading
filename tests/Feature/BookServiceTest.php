<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\BookService;
use GuzzleHttp\Handler\MockHandler;
use Tests\Support\WorksWithBookClient;

class BookServiceTest extends TestCase
{
    use WorksWithBookClient;
    /**
     * @var MockHandler
     */
    private $mockHandler;

    /**
     * @var BookService
     */
    private $bookService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = $this->swapBookClient();
        $this->bookService = app(BookService::class);
    }


    /**
     * @test
     * @throws \JsonException
     */
    public function canFetchBooksByQuery(): void
    {
        $this->mockHandler->append($this->mockBookSingleResponse());
        $results = $this->bookService->search('peeps');

        $this->assertCount(1, $results);
    }

    /**
     * We don't want any null values showing up on the front end
     * @test
     * @throws \JsonException
     */
    public function allFieldsHaveInput(): void
    {
        $this->mockHandler->append($this->mockBookDummyResponse());
        $results = $this->bookService->search('peeps');

        $this->assertCount(1, $results);
        $this->assertNull($results[0]['lookup_id']); // Should never be null
        $this->assertEquals('Tony Keiser, Aiden Keiser', $results[0]['authors']);
        $this->assertEquals('No Description Provided', $results[0]['description']);
        $this->assertCount(0, $results[0]['categories']);
        $this->assertEquals('Unknown', $results[0]['publisher']);
        $this->assertEquals('Unknown', $results[0]['published']);
        $this->assertEquals('Not Rated', $results[0]['rating']);
        $this->assertEquals(0, $results[0]['ratings']);
        $this->assertEquals(config('book')['placeholder']['src'], $results[0]['image']);
    }
}
