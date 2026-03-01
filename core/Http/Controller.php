<?php

declare(strict_types=1);

namespace Core\Http;

use Core\View\PhpEngine;
use Core\View\EngineInterface;

abstract class Controller
{
    private EngineInterface $engine;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/app.php';

        $viewPath = $config['paths']['views'];

        $this->engine = new PhpEngine($viewPath);
    }

    protected function view(string $view, array $data = []): void
    {
        $this->engine->render($view, $data);
    }
}
