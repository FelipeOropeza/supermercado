<?php

/**
 * Script Customizado para Iniciar o Servidor
 * Ele lê o .env e exibe a URL correta e clicável no console!
 */

require __DIR__ . '/vendor/autoload.php';

// Carrega as variáveis do .env
if (class_exists(\Dotenv\Dotenv::class) && file_exists(__DIR__ . '/.env')) {
    $dotenv = \Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->safeLoad();
}

$port = getenv('PORT') ?: 8000;
$host = getenv('HOST') ?: 'localhost';

// Identifica a rota padrão
$defaultRoute = getenv('APP_DEFAULT_ROUTE') ?: '/';

// Tira a barra extra se existir para não ficar '//login'
$defaultRoute = ltrim($defaultRoute, '/');
$fullUrl = "http://{$host}:{$port}/{$defaultRoute}";

echo "\n";
echo "=======================================================\n";
echo " 🚀 Servidor de Desenvolvimento MVC Base Iniciado! \n";
echo "=======================================================\n";
echo " 🔗 Acesse a aplicação clicando no link abaixo:\n";
echo " 👉 \033[1;32m{$fullUrl}\033[0m\n";
echo "-------------------------------------------------------\n";
echo " Pressione Ctrl+C para encerrar o servidor.\n\n";

// Oculta log massivo de requests redirecionando as saidas pro limbo de acordo com o Sistema Operacional
$nullDevice = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'NUL' : '/dev/null';

// Executa o servidor nativo do PHP de forma silenciosa e repassa o controle de vida
passthru("php -S {$host}:{$port} -t public > {$nullDevice} 2>&1");
