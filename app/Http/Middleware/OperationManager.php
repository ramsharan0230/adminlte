<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class OperationManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role->slug == 'operation-manager') {
            return $next($request);
        }

        if (Auth::user()->role->slug == 'site-manager') {
            return redirect()->route('sitemanager');
        }

        if (Auth::user()->role->slug == 'hygiene') {
            return redirect()->route('hygiene');
        }

        if (Auth::user()->role->slug == 'senior-operation-manager') {
            return redirect()->route('senioroperationmanager');
        }

        return $next($request);
    }
}
