<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Attribute\CachedJokes;

class JokeCachedService extends JokeService implements JokeInterface
{
    #[CachedJokes]
    public function getRandomJoke(): array
    {
        return parent::getRandomJoke();
    }
}
