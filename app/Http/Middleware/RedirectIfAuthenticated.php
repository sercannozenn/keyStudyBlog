<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard)
        {
            if (Auth::guard($guard)->check())
            {
                $role = Auth::user()->roles[0]->name;

                switch ($role)
                {
                    case 'Admin':
                        return redirect()->route('dashboard');
                    case 'Moderator':
                        return redirect()->route('dashboard');
                    case 'Writer':
                        return redirect()->route('dashboard');
                    case 'Reader':
                        return redirect()->route('index');
                    default:
                        return redirect()->route('index');
                }
            }
        }
        return $next($request);
    }
}
