<?php

namespace Modules\SeniorOperationManager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\Inspection\Entities\Inspection;
use Modules\Role\Entities\Role;

class SeniorOperationManagerController extends Controller
{
    private $seniorOperationManagers;
    private $operationManagers;
    private $siteManagers;
    private $hygienes;
    private $inspections;

    public function __construct(User $user, Inspection $inspection)
    {
        $this->middleware('auth');
        //users
        $this->seniorOperationManagers = $user->srOperationManagers();
        $this->operationManagers = $user->operationManagers();
        $this->siteManagers = $user->siteManagers();
        $this->hygienes = $user->hygienes();

        //inspection
        $this->inspections = $inspection->seniorOperationManagerInspections();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $inspections = $this->inspections;
        return view('senioroperationmanager::index', compact('inspections'));
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

    public function seniorOperationManagers(){
        $seniorOperationManagers = $this->seniorOperationManagers;
        return view('senioroperationmanager::senior_operation_managers', compact('seniorOperationManagers'));
    }

    public function operationManagers(){
        $operationManagers = $this->operationManagers;
        return view('senioroperationmanager::operation-manager', compact('operationManagers'));
    }

    public function siteManagers(){
        $siteManagers = $this->siteManagers;
        return view('senioroperationmanager::operation-manager', compact('siteManagers'));
    }

    public function hygienes(){
        $hygienes = $this->hygienes;
        return view('senioroperationmanager::operation-manager', compact('hygienes'));
    }
    
}
