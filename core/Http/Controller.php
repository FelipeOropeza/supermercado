<?php

declare(strict_types=1);

namespace Core\Http;

use Core\View\EngineInterface;

abstract class Controller
{
    public function __construct()
    {
        // O engine é resolvido via helper global app() nos controllers filhos
    }
}
