<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function register(){
        return view('pages.register');
    }

    public function dashboard(){
        return view('pages.dashboard');
    }

    public function inspects(){
        return view('inspection.list');
    }

    public function addInspection(){
        return view('inspection.add');
    }

    public function inspect1(){
        return view('inspection.list1');
    }

    public function hygienes(){
        return view('hygienes.list');
    }
}
