<?php

namespace Modules\Hygiene\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\Inspection\Entities\Inspection;
use Hash;
use Validator;
use Auth;

class HygieneController extends Controller
{

    private $hygienes;

    public function __construct(User $user, Inspection $inspection)
    {
        $this->middleware('auth');
        $this->hygienes = $user->hygienes();
        $this->inspection = $inspection->hygieneInspections();

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $inspections = $this->inspection->where('user_id', Auth::id())->get();
        return view('hygiene::index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hygiene::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hygiene::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hygiene::edit');
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

    public function users(){
        $users = $this->hygienes;
        return view('hygiene::users', compact('users'));
    }

    public function updateUser(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:3|max:100',
            'email' => 'email|required',
            'phone' => 'required|max:15',
            'role_id' => 'required|integer',
            'branch_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->except(['fullname','_token', 'user_id', 'password', 'password_confirmation']);
        $data['name'] = $request->fullname;
        if($request->password !=null){
            $password = Hash::make($request->password);
        }else{
            $userUpdate = User::findOrFail(Auth::user()->id)->first();
            $password = $userUpdate->password;
        }
        
        $data['password'] = $password;
        $user = User::where('id', Auth::user()->id)->update($data);

        if($user)
            return redirect()->route('hygiene.users')->with(['success'=>"User updated successfully!"]);
        else
            return redirect()->back()->withErrors(['msg'=>"Sorry! Something went wrong"]);
    }
}
