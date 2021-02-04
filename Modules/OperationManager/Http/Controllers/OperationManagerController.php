<?php

namespace Modules\OperationManager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\Inspection\Entities\Inspection;
use Auth;

class OperationManagerController extends Controller
{
    private $operation_managers;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->operation_managers = $user->operationManagers();
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = $this->operation_managers;

        $inspections = Inspection::whereStatus(1)->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        return view('operationmanager::index', compact('users', 'inspections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('operationmanager::create');
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
        return view('operationmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('operationmanager::edit');
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
        $operation_managers = $this->operation_managers;
        return view('operationmanager::operation-manager', compact('operation_managers'));
    }
}
