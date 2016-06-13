<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->check()) {
            if(Auth::user()->type == 1)
                return Redirect::route('stock');
            if(Auth::user()->type == 2)
                return Redirect::route('sale');
            if(Auth::user()->type == 3)
                return Redirect::route('finance');
            if(Auth::user()->type == 4)
                return Redirect::route('manager');
            if(Auth::user()->type == 5)
                return Redirect::route('admin');
        }

        return $next($request);
    }
}
