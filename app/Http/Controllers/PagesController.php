<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Branch\Entities\Branch;
use Modules\User\Entities\User;
use Modules\Role\Entities\Role;

class PagesController extends Controller
{
    private $branch;
    private $role;
    private $user;
    public function __construct(Branch $branch, User $user, Role $role){
        $this->branch = $branch;
        $this->user = $user;
        $this->role = $role;
    }   

    public function register(){
        $branches = $this->branch->status()->all();
        $roles = $this->role->where('slug', '!=', 'operation-manager')
            ->where('slug', '!=', 'senior-operation-manager')
            ->where('status', 1)->get();
        return view('pages.register', compact('branches', 'roles'));
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
