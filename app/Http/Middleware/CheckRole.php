<?php

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        if ($currentUser->isAdmin()) {
            throw new UnauthorizedHttpException('Unauthorized access.');
        }

        return $next($request);
    }

}