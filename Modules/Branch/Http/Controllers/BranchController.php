<?php

namespace Modules\Branch\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Branch\Entities\Branch;
use Modules\User\Entities\User;
use Modules\Branch\Entities\MainOffice;
use Validator;
use Hash;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $branches = Branch::orderBy('created_at', 'DESC')->get();
        $main_branches = MainOffice::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('branch::index', compact('branches', 'main_branches'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('branch::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'office_name' => 'required|string',
        'email' => 'sometimes|email|max:50',
        'main_office_id'=>'required|integer',
        'address' => 'sometimes|max: 199',
        'phone' => 'sometimes|max:20',
        'fax' => 'sometimes|max:20',
        ]);
        
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['name'] = $request->office_name;
        $branch = Branch::create($data);

        if($branch)
            return redirect()->route('senioroperationmanager.branch')->with(['success'=>'Branch created successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch')->with(['error'=>'Something went Wrong!!!']);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function disapprove($id)
    {
            $branch = Branch::where('id', $id)->update(['status'=>0]);
    
            if($branch)
                return redirect()->route('senioroperationmanager.branch')->with(['success'=>'Branch disapproved successfully!!!']);
            else
                return redirect()->route('senioroperationmanager.branch')->with(['error'=>'Something went Wrong!!!']);
    
    }

    public function approve($id)
    {
            $branch = Branch::where('id', $id)->update(['status'=>1]);
    
            if($branch)
                return redirect()->route('senioroperationmanager.branch')->with(['success'=>'Branch approved successfully!!!']);
            else
                return redirect()->route('senioroperationmanager.branch')->with(['error'=>'Something went Wrong!!!']);
    
    }


    public function detail($id)
    {
        $branch = Branch::where('id', $id)->with('users')->first();
        
        return view('branch::detail', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'editId'=>'required|integer',
            'office_name' => 'required|string',
            'email' => 'sometimes|email|max:50',
            'main_office_id'=>'required|integer',
            'address' => 'sometimes|max: 199',
            'phone' => 'sometimes|max:20',
            'fax' => 'sometimes|max:20',
            ]);
            
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name'] = $request->office_name;
        $data['email'] = $request->email;
        $data['main_office_id'] = $request->main_office_id;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['fax'] = $request->fax;
        $branchUpdate = Branch::where('id', $request->editId)->update($data);

        if($branchUpdate)
            return redirect()->route('senioroperationmanager.branch')->with(['success'=>'Branch updated successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch')->with(['error'=>'Something went Wrong!!!']);
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

    public function create_user(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:3|max:100',
            'role_id' => 'required|integer',
            'email' => 'email|required',
            'address'=>'sometimes|string|max:100',
            'phone'=>'max:20',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'branch_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->all();
        $data['name'] = $request->fullname;
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = $request->role_id;

        $user = User::create($data);
        if($user)
            return redirect()->back()->with(['success'=>"User has been created successfully!"]);
        else
            return redirect()->back()->withErrors(['msg'=>"User has been created successfully!"]);
    }

    public function update_user(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'fullname' => 'required|min:3|max:100',
            'role_id' => 'required|integer',
            'email' => 'email|required',
            'address'=>'string|max:100',
            'phone'=>'max:20',
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = $request->all();
        $data['name'] = $request->fullname;
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = $request->role_id;
        
        unset($data['_token']);
        unset($data['password_confirmation']);
        unset($data['user_id']);
        unset($data['fullname']);


        $user = User::where('id', $request->user_id)->update($data);
        if($user)
            return redirect()->back()->with(['success'=>"User has been updated successfully!"]);
        else
            return redirect()->back()->withErrors(['msg'=>"User has been created successfully!"]);
    }

    public function delete_user($id){
        $userFound = User::findOrFail($id)->first();
        $userDelete = User::where('id', $id)->update(['status'=>0]);
    
        if($userDelete)
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['success'=>'User Deleted successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function approve_user($id){
        $userFound = User::findOrFail($id)->first();
        $userAapprove = User::where('id', $id)->update(['current_status'=>'approved']);
    
        if($userAapprove)
            return redirect()->back()->with(['success'=>'User Approved successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function disapprove_user($id){
        $userFound = User::findOrFail($id)->first();
        $userAapprove = User::where('id', $id)->update(['current_status'=>'suspended']);
    
        if($userAapprove)
            return redirect()->back()->with(['success'=>'User Suspended successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function enable_user($id){
        $userFound = User::findOrFail($id)->first();
        $userNormalized = User::where('id', $id)->update(['current_status'=>'approved']);
    
        if($userNormalized)
            return redirect()->back()->with(['success'=>'User Approved successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function disable_user($id){
        $userFound = User::findOrFail($id)->first();
        $userSuspended = User::where('id', $id)->update(['current_status'=>'suspended']);

        if($userSuspended)
            return redirect()->back()->with(['success'=>'User Suspended successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function normalized_user($id){
        $userFound = User::findOrFail($id)->first();
        $userSuspended = User::where('id', $id)->update(['current_status'=>'normal']);

        if($userSuspended)
            return redirect()->back()->with(['success'=>'User Normalized successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }
}
