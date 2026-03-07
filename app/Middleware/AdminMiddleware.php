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
            // Se não tá logado ou não é admin, vaza
            return \Core\Http\Response::makeRedirect('/login');
        }

        return $next($request);
    }
}
