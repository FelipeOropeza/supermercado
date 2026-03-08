<?php

/**
 * Router script para o servidor embutido do PHP.
 * Permite simular o mod_rewrite (Clean URLs) sem precisar de Apache/Nginx.
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Se o arquivo existir fisicamente na pasta public, o servidor embutido deve servi-lo diretamente
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

// Caso contrário, tudo cai no index.php
require_once __DIR__ . '/public/index.php';
