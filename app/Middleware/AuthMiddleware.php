<?php

namespace App\Middleware;

use Closure;
use Core\Contracts\MiddlewareInterface;
use Core\Http\Request;
use Core\Http\Response;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('user')) {
            if ($request->isHtmx()) {
                return (new Response('', 401))->hxRedirect('/login');
            }

            return Response::makeRedirect('/login');
        }

        return $next($request);
    }
}
