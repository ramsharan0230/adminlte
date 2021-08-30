<?php

namespace Modules\SeniorOperationManager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\Inspection\Entities\Inspection;
use Modules\Role\Entities\Role;
use Auth;

class SeniorOperationManagerController extends Controller
{
    private $seniorOperationManagers;
    private $operationManagers;
    private $siteManagers;
    private $hygienes;
    private $inspections;
    private $inspectionAll;
    private $user;
    private $model;

    public function __construct(User $user, Inspection $inspection)
    {
        $this->middleware('auth');
        //users
        $this->seniorOperationManagers = $user->srOperationManagers();
        $this->operationManagers = $user->operationManagers();
        $this->siteManagers = $user->siteManagers();
        $this->hygienes = $user->hygienes();
        $this->model = $inspection;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //inspection
        $inspections = $this->model->seniorOperationManagerInspections(Auth::user()->branch_id);

        return view('senioroperationmanager::index', compact('inspections'));
    }

    public function branchAllInspections()
    {
        $inspections = $this->model->seniorOperationManagerInspectionsAll(Auth::user()->branch_id);
        return view('senioroperationmanager::inspeciton-all', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('senioroperationmanager::create');
    }

    public function roles()
    {
        $roles = Role::where('status', 1)->get();
        return response()->json(['data'=>$roles, 'status'=>200]);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('senioroperationmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('senioroperationmanager::edit');
    }

    public function seniorOperationManagers(){
        $seniorOperationManagers = $this->seniorOperationManagers;
        return view('senioroperationmanager::senior_operation_managers', compact('seniorOperationManagers'));
    }

    public function operationManagers(){
        $operationManagers = $this->operationManagers;
        return view('senioroperationmanager::operation-manager', compact('operationManagers'));
    }

    public function siteManagers(){
        $siteManagers = $this->siteManagers->where('branch_id', Auth::user()->branch_id);
        return view('senioroperationmanager::site-managers', compact('siteManagers'));
    }

    public function hygienes(){
        $role_id = [2,3,4];
        $hygienes = $this->user->whereNotIn('role_id', $role_id)->where('branch_id', Auth::user()->branch_id)->get();
        return view('senioroperationmanager::hygienes', compact('hygienes'));
    }

    public function approveHygiene($id){
        $hygienes = $this->user->where('id', $id)->update(
            [
                'current_status'=>'approved',
                'role_id' => 1,
                'status'=>1
            ]
        );
        return redirect()->back()->with('message', 'User Updated Successfully!');
    }

    public function suspendHygiene($id){
        $hygienes = $this->user->where('id', $id)->update(
            [
                'current_status'=>'suspended',
                'role_id' => 1,
                'status'=>0
            ]
        );
        return redirect()->back()->with('message', 'User Suspended Successfully!');
    }
    
    public function approveSiteManager($id){
        $hygienes = $this->user->where('id', $id)->update(
            [
                'current_status'=>'approved',
                'status'=>1
            ]
        );
        return redirect()->back()->with('message', 'User Updated Successfully!');
    }

    public function suspendSiteManager($id){
        $hygienes = $this->user->where('id', $id)->update(
            [
                'current_status'=>'suspended',
                'role_id' => 2,
                'status'=>0
            ]
        );
        return redirect()->back()->with('message', 'User Suspended Successfully!');
    }

    public function suspendSeniorOperationManager($id){
        $hygienes = $this->user->where('id', $id)->update(
            [
                'current_status'=>'suspended',
                'role_id' => 4,
                'status'=>0
            ]
        );

        if(Auth::id() == $id){
            Auth::logout();
        }

        return redirect()->back()->with('message', 'User Suspended Successfully!');
    }

    public function approveSeniorOperationManager($id){
        $hygienes = $this->user->where('id', $id)->update(
            [
                'current_status'=>'approved',
                'status'=>1
            ]
        );

        if(Auth::id() == $id){
            Auth::logout();
        }

        return redirect()->back()->with('message', 'User Suspended Successfully!');
    }
    
}
