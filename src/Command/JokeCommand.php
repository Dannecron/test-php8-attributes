<?php

declare(strict_types=1);

namespace App\Command;

use App\Operation\JokeOperation;

class JokeCommand extends \Ahc\Cli\Input\Command
{
    public function __construct(
        private JokeOperation $jokeOperation
    ) {
        parent::__construct('joke', 'Get some joke');
    }

    public function execute(): void
    {
        $io = $this->app()->io();
        $joke = $this->jokeOperation->getRandomJoke();
        $io->green($joke, true);
    }
}
