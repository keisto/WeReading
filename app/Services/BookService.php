<?php

namespace App\Services;

use App\Http\Client\BookClient;

class BookService
{
    /**
     * @var BookClient
     */
    private $client;

    public function __construct(BookClient $client)
    {
        $this->client = $client;
    }

    public function search($input, $index = 0)
    {
        $index = $index ?: 0; // if null -> 0
        $url = "volumes?q={$input}&startIndex={$index}";
        $response = $this->client->get($url);
        $body = json_decode($response->getBody(), true);

        if ($response->getStatusCode() !== 200) {
            // Error
            return $response->getStatusCode();
        }

        if ($body['totalItems'] === 0) {
            return []; // No Results
        }

        return collect($body['items'])->map(function ($book) {
            $info = $book['volumeInfo'];

            return [
                'lookup_id' => $book['id'] ?? null, // can be used for checking duplicates & single querying maybe for a book details page...
                'title' => $info['title'] ?? 'Untitled',
                'authors' => implode(', ', $info['authors'] ?? ['Unknown']),
                'description' => $info['description'] ?? 'No Description Provided',
                'categories' => $info['categories'] ?? [],
                'publisher' => $info['publisher'] ?? 'Unknown',
                'published' => $info['publishedDate'] ?? 'Unknown',
                'rating' => $info['averageRating'] ?? 'Not Rated',
                'ratings' => $info['ratingsCount'] ?? 0,
                'image' => $info['imageLinks']['thumbnail'] ?? config('book')['placeholder']['src']
            ];
        });
    }
}
