<?php

declare(strict_types=1);

namespace App\Operation;

use App\Service\Attribute\CachedJokes;
use App\Service\JokeInterface;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class JokeOperation
{
    public function __construct(
        protected JokeInterface $jokeService,
        protected CacheInterface $cache
    ) {
    }

    /**
     * Get text of random joke
     * @return string
     * @throws InvalidArgumentException
     */
    public function getRandomJoke(): string
    {
        $reflection = new \ReflectionClass($this->jokeService);
        $cachedJokesAttr = $reflection->getMethod('getRandomJoke')->getAttributes(CachedJokes::class);
        if (count($cachedJokesAttr) > 0) {
            /** @var CachedJokes $cache */
            $cache = $cachedJokesAttr[0]->newInstance();
            $cacheKey = $cache->getCacheKey(JokeInterface::CATEGORY_ANY);
            if ($this->cache->has($cacheKey)) {
                return $this->cache->get($cacheKey);
            }
        }

        $randomJoke = $this->jokeService->getRandomJoke();
        $randomJokeStr = $randomJoke['joke'];
        if (isset($cacheKey)) {
            $this->cache->set($cacheKey, $randomJokeStr);
        }

        return $randomJokeStr;
    }
}
