<?php

declare(strict_types=1);

namespace App\Command;

use App\Operation\JokeOperation;
use Psr\SimpleCache\InvalidArgumentException;

class JokeCommand extends \Ahc\Cli\Input\Command
{
    public function __construct(
        private JokeOperation $jokeOperation,
        private JokeOperation $jokeOperationWithCache,
    ) {
        parent::__construct('joke', 'Get some joke');
    }

    public function execute(): void
    {
        $io = $this->app()->io();

        try {
            $joke = $this->jokeOperation->getRandomJoke();
            $io->green("Joke: {$joke}", true);

            $cachedJoke = $this->jokeOperationWithCache->getRandomJoke();
            $io->green("Cached joke: {$cachedJoke}", true);
        } catch (\Throwable | InvalidArgumentException $exception) {
            $io->error($exception->getMessage(), true);
        }
    }
}
