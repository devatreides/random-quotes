<?php

namespace Tombenevides\RandomQuotes;

use GuzzleHttp\Client;

class RandomQuote
{
    const BASE_ENDPOINT = 'https://api.quotable.io/random';

    public function __construct(
        private Client $client = new Client
    ){}

    public function from(string $author): string
    {
        $response = $this->client->get(self::BASE_ENDPOINT, [
            'query' => [
                'author' => str_replace(' ','_',$author)
            ]
        ])->getBody()->getContents();

        $quote = json_decode($response, true);

        return "{$quote['content']} by {$author}";
    }
}