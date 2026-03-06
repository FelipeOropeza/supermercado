<?php

namespace App\Middleware;

use Closure;
use Core\Contracts\MiddlewareInterface;
use Core\Http\Request;

class AdminMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user') || session()->get('user')['role'] !== 'admin') {
            // Em aplicação real, redirecionamos para / ou damos erro 403.
            return \Core\Http\Response::makeRedirect('/dashboard');
        }

        return $next($request);
    }
}
