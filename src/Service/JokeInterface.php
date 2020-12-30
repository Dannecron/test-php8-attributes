<?php

declare(strict_types=1);

namespace App\Service;

interface JokeInterface
{
    public const CATEGORY_ANY = 'Any';
    public const CATEGORY_MISC = 'Miscellaneous';
    public const CATEGORY_PROGRAMMING = 'Programming';
    public const CATEGORY_DARK = 'Dark';
    public const CATEGORY_PUN = 'Pun';
    public const CATEGORY_SPOOKY = 'Spooky';
    public const CATEGORY_CHRISTMAS = 'Christmas';

    public function getRandomJoke(): array;
}
