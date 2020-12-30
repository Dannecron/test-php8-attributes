<?php

require_once __DIR__ . '/vendor/autoload.php';

$jokeGuzzle = new \GuzzleHttp\Client([
    'base_uri' => 'https://v2.jokeapi.dev',
]);

$cache = new \Sarahman\SimpleCache\FileSystemCache(__DIR__ . '/tmp/cache');

$jokeService = new \App\Service\JokeService($jokeGuzzle);
$jokeCacheService = new \App\Service\JokeCachedService($jokeGuzzle);
$jokeOperation = new \App\Operation\JokeOperation($jokeService, $cache);
$jokeOperationWithCache = new \App\Operation\JokeOperation($jokeCacheService, $cache);

$app = new \Ahc\Cli\Application('Joke App', 'v0.0.1');
$app->add(new \App\Command\JokeCommand($jokeOperation, $jokeOperationWithCache));
$app->handle($_SERVER['argv']);
