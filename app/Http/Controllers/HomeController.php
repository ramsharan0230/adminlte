<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        // dd(Auth::user()->role->slug);
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role->slug == 'hygiene') {
            return redirect()->route('hygiene');
        }

        $destinations = [
            1 => 'hygiene',
            2 => 'site-manager',
            3 => 'operation-manager',
            4 => 'senior-operation-manager'
        ];

        return redirect(route($destinations[Auth()::user()->role->slug]));

        return view('home');
    }
}
