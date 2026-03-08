<?php

/**
 * Router script para o servidor embutido do PHP.
 * Permite simular o mod_rewrite (Clean URLs) sem precisar de Apache/Nginx.
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Se o arquivo existe fisicamente dentro de public/, servimos direto (arquivos estáticos: CSS, JS, imagens, storage)
$publicPath = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($publicPath) && is_file($publicPath)) {
    return false; // PHP built-in server serves the file directly
}

// Normaliza o ambiente para o framework (garante que o SCRIPT_NAME esteja correto)
$_SERVER['SCRIPT_NAME']     = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';

require_once __DIR__ . '/public/index.php';
