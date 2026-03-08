<?php

/**
 * Router script para o servidor embutido do PHP.
 * Permite simular o mod_rewrite (Clean URLs) sem precisar de Apache/Nginx.
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Com o uso de -t public no comando, o PHP já serve arquivos estáticos.
// Este script só é invocado quando o arquivo solicitado não existe fisicamente.

// Normaliza o ambiente para o framework
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';

require_once __DIR__ . '/public/index.php';
