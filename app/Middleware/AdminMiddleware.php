<?php

namespace App\Middleware;

use Closure;
use Core\Contracts\MiddlewareInterface;
use Core\Http\Request;

class AdminMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next): \Core\Http\Response
    {
        $user = session('user');

        if (!$user || ($user['role'] ?? '') !== 'admin') {
            if ($request->isAjax() || $request->isHtmx()) {
                return \Core\Http\Response::makeJson(['error' => 'Acesso restrito apenas para administradores.'], 403);
            }

            fail_validation('auth', 'Você não tem permissão para acessar esta área.');
            return \Core\Http\Response::makeRedirect('/login');
        }

        return $next($request);
    }
}
