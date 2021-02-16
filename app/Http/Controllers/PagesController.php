<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Branch\Entities\Branch;
use Modules\User\Entities\User;

class PagesController extends Controller
{
    private $branch;
    public function __construct(Branch $branch, User $user){
        $this->branch = $branch;
        $this->user = $user;
    }   

    public function register(){
        $branches = $this->branch->status()->all();
        return view('pages.register', compact('branches'));
    }

    public function tempDashboard($id){
        $user = $this->user->whereId($id)->first();
        return view('pages.temp-dashboard', compact('user'));
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
