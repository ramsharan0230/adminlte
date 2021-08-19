<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth, Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = User::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('user::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::register');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' =>'required|integer',
            'fullname' => 'required|min:3|max:100',
            'email' => 'email|required',
            'phone' => 'sometimes|max:17',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'terms' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->all();
        $data['name'] = $request->fullname;
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 5;

        $user = User::create($data);
        if($user)
            return redirect()->route('user-temp-dashboard', $user->id)->with(['success'=>"User has been created successfully!"]);
        else
            return redirect()->back()->withErrors(['msg'=>"User has been created successfully!"]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function logout(){
        Auth::logout();
        Session::flush();
	    return Redirect::to('/');
    }
}
