<?php

namespace Tests\Support;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use App\Http\Client\BookClient;
use GuzzleHttp\Handler\MockHandler;

trait WorksWithBookClient
{
    public function swapBookClient(): MockHandler
    {
        $mockHandler = new MockHandler();

        $client = new BookClient([
            'handler' => HandlerStack::create($mockHandler)
        ]);

        $this->app->instance(BookClient::class, $client);

        return $mockHandler;
    }

    /**
     * Note: Some details removed from response see: https://developers.google.com/books/docs/v1/using#PerformingSearch
     *
     * @return Response
     * @throws \JsonException
     */
    public function mockBookSingleResponse(): Response
    {
        return new Response(200, [], json_encode([
            'lookup_id' => 'f8i7HRcJCnEC',
            'totalItems' => 1,
            'items' => [
                [
                    'volumeInfo' => [
                        'title' => 'Peeps',
                        'authors' => ['Scott Westerfeld'],
                        'publisher' => 'Penguin',
                        'publishedDate' => '2006-09-07',
                        'description' => 'A year ago, Cal Thompson was a college freshman more interested in meeting girls and partying than in attending biology class. Now, after a fateful encounter with a mysterious woman named Morgan, biology has become, literally, Cal\'s life. Cal was infected by a parasite that has a truly horrifying effect on its host. Cal himself is a carrier, unchanged by the parasite, but he\'s infected the girlfriends he\'s had since Morgan. All three have turned into the ravening ghouls Cal calls Peeps. The rest of us know them as vampires. It\'s Cal\'s job to hunt them down before they can create more of their kind. . . . Bursting with the sharp intelligence and sly humor that are fast becoming his trademark, Scott Westerfeld\'s novel is an utterly original take on an archetype of horror.',
                        'categories' => [
                            'Young Adult Fiction'
                        ],
                        'averageRating' => 3.5,
                        'ratingsCount' => 64,
                        'imageLinks' => [
                            'thumbnail' => 'http://books.google.com/books/content?id=f8i7HRcJCnEC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'
                        ],
                    ],
                ]
            ]
        ], JSON_THROW_ON_ERROR));
    }

    /**
     * Edge Case: Dummy response but this could happen.
     *
     * @return Response
     * @throws \JsonException
     */
    public function mockBookDummyResponse(): Response
    {
        return new Response(200, [], json_encode([
            'totalItems' => 1,
            'items' => [
                [
                    'volumeInfo' => [
                        'title' => 'Tony & Son',
                        'authors' => ['Tony Keiser', 'Aiden Keiser'],
                    ],
                ]
            ]
        ], JSON_THROW_ON_ERROR));
    }

    /**
     * TODO: Edge Case: Empty Search Result
     *
     * @return Response
     * @throws \JsonException
     */
    public function mockBookEmptyResponse(): Response
    {
//        return new Response(200, [], json_encode([
//            'totalItems' => 0,
//        ], JSON_THROW_ON_ERROR));
    }

    /**
     * TODO: Edge Case: Unsuccessful response
     *
     * @return Response
     * @throws \JsonException
     */
    public function mockBookBadResponse(): Response
    {
//        return new Response(500, [], json_encode([
//
//        ], JSON_THROW_ON_ERROR));
    }
}
