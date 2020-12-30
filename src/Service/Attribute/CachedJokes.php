<?php

declare(strict_types=1);

namespace App\Service\Attribute;

use Psr\SimpleCache\CacheInterface;

#[\Attribute(\Attribute::TARGET_METHOD)]
class CachedJokes
{
    public function getCacheKey(string $jokeType): string
    {
        return "jokes-{$jokeType}";
    }
}
