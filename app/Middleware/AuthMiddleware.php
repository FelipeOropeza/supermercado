<?php

namespace App\Middleware;

use Closure;
use Core\Contracts\MiddlewareInterface;
use Core\Http\Request;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user')) {
            return \Core\Http\Response::makeRedirect('/login');
        }

        return $next($request);
    }
}
