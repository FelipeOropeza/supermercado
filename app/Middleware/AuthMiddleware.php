<?php

namespace App\Middleware;

use Closure;
use Core\Contracts\MiddlewareInterface;
use Core\Http\Request;
use Core\Http\Response;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next):Response
    {
        $user = session('user');

        if (!$user) {
            if ($request->isHtmx()) {
                return (new Response('', 401))->hxRedirect('/login');
            }
            return Response::makeRedirect('/login');
        }

        // Apenas 'cliente' pode acessar as rotas protegidas comuns (Minha Conta, Checkout, etc.)
        if ($user['role'] !== 'cliente') {
            return Response::makeRedirect('/admin');
        }

        return $next($request);
    }
}
