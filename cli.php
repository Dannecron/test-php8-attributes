<?php

require_once __DIR__ . '/vendor/autoload.php';

$jokeGuzzle = new \GuzzleHttp\Client([
    'base_uri' => 'https://v2.jokeapi.dev',
]);

$cache = new \Sarahman\SimpleCache\FileSystemCache(__DIR__ . '/tmp/cache');
$jokeService = new \App\Service\JokeService($jokeGuzzle);
$jokeOperation = new \App\Operation\JokeOperation($jokeService, $cache);

$app = new \Ahc\Cli\Application('Joke App', 'v0.0.1');
$app->add(new \App\Command\JokeCommand($jokeOperation));
$app->handle($_SERVER['argv']);
