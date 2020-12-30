<?php

declare(strict_types=1);

namespace App\Service;

#[\Attribute]
class CachedJokes
{
    public function getCacheKey(string $jokeType): string
    {
        return "jokes-{$jokeType}";
    }
}
