<?php

namespace App\Middleware;

use Closure;
use Core\Contracts\MiddlewareInterface;
use Core\Http\Request;
use Core\Http\Response;

class AdminMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = session('user');

        if (!$user || ($user['role'] ?? '') !== 'admin') {
            if ($request->isAjax() || $request->isHtmx()) {
                return Response::makeJson(['error' => 'Acesso restrito apenas para administradores.'], 403);
            }

            fail_validation('auth', 'Você não tem permissão para acessar esta área.');
            return Response::makeRedirect('/login');
        }

        return $next($request);
    }
}
