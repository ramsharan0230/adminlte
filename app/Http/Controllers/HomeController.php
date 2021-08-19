<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if(Auth::user()->current_status == "normal"){
            Auth::logout();
            Session::flush();
            return redirect()->back()->with('message', 'Contact your admin for your role upgrading!')
            ->withInput(Auth::user()->email);
        }

        if (Auth::user()->role->slug == 'hygiene') {
            return redirect()->route('hygiene');
        }

        if (Auth::user()->role->slug == 'site-manager') {
            return redirect()->route('sitemanager');
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
}
