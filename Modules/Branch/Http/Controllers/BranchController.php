<?php

namespace Modules\Branch\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\MainOffice;
use Validator;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $branches = Branch::all();
        $main_branches = MainOffice::where('status', 1)->get();
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
        $branch = Branch::where('id', $id)->where('status', 1)->with('users')->first();
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
}
