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
            if ($request->isApi()) {
                return Response::makeJson(['error' => 'Acesso restrito apenas para administradores.'], 403);
            }

            if ($request->isHtmx()) {
                return (new Response('', 403))->hxRedirect('/login');
            }

            abort(403, 'Você não tem permissão para acessar esta área.');
        }

        return $next($request);
    }
}

