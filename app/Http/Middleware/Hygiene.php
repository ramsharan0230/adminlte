<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class Hygiene
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

        if (Auth::user()->role->slug == 'site-manager') {
            return redirect()->route('sitemanager');
        }

        if (Auth::user()->role->slug == 'hygiene') {
            return $next($request);
        }

        if (Auth::user()->role->slug == 'operation-manager') {
            return redirect()->route('operationmanager');
        }

        if (Auth::user()->role->slug == 'senior-operation-manager') {
            return redirect()->route('senioroperationmanager');
        }

        if (Auth::user()->role->slug == 'normal-user') {
            return redirect()->route('user-temp-dashboard', Auth::id());
        }

        return $next($request);
    }

    public function __construct(User $user){
        $user->CheckUserStatus();
    }

}
