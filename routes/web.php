<?php

use App\Controllers\HomeController;
use Core\Routing\Route;

/** @var \Core\Routing\Router $router */

// ==========================================
// ROTAS DE APLICAÇÃO (WEB / HTML)
// ==========================================

// Inclui Rotas de Autenticação Auxiliares
require_once __DIR__ . '/auth.php';

// Inclui Rotas do Painel Administrativo
require_once __DIR__ . '/admin.php';
