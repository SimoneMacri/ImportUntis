<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */


    public function handle($request, Closure $next, $guard = null)
    {
        \Auth::attempt(['username' => 'root', 'password' => '123123']);
        error_log(print_r(bcrypt('12123'), true));

        error_log(print_r(\Auth::check() ? "true" : 'false', true));

        /*if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->guest('login');
        }*/

        return $next($request);
    }
}