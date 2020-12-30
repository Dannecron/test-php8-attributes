<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Http\Message\ResponseInterface;

/**
 * Class JokeService
 * @link https://sv443.net/jokeapi/v2
 */
class JokeService implements JokeInterface
{
    public function __construct(
        protected \GuzzleHttp\Client $guzzleClient
    ) {
    }

    #[CachedJokes]
    public function getRandomJoke(): array
    {
        $response = $this->sendRequest(static::CATEGORY_ANY);
        $responseContent = (string) $response->getBody();
        return \json_decode($responseContent, true);
    }

    protected function sendRequest(string ...$categories): ResponseInterface
    {
        $categoriesStr = implode(',', $categories);
        return $this->guzzleClient->get("/joke/{$categoriesStr}", [
            \GuzzleHttp\RequestOptions::QUERY => [
                'format' => 'json',
                'amount' => 1,
                'type' => 'single',
            ],
        ]);
    }
}
