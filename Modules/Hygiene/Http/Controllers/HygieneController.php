<?php

namespace Modules\Hygiene\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\Inspection\Entities\Inspection;
use Auth;

class HygieneController extends Controller
{

    private $hygienes;

    public function __construct(User $user, Inspection $inspeciion)
    {
        $this->middleware('auth');
        $this->hygienes = $user->hygienes();
        $this->inspections = $inspeciion->hygieneInspections();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $inspections = $this->inspections;
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
}
