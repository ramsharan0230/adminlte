<?php

namespace Modules\SiteManager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inspection\Entities\Inspection;
use Modules\User\Entities\User;
use Modules\Review\Entities\Review;
use Modules\Hygiene\Exports\InspectionsExport;
use Modules\Hygiene\Exports\InspectionsUnSubmittedExport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Auth, PDF;

class SiteManagerController extends Controller
{

    private $sitemanagers;
    private $branch;
    private $user;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->sitemanagers = $user->siteManagers();
        $this->user = $user;
        // dd($user->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get());
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $inspections= array();
        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch;
        // dd($branch);
        $branch_users = $branch->users()->get();
        foreach($branch_users as $user){
            foreach($user->inspections as $inspection){
                array_push($inspections, $inspection);
            }
        }
        $inspections = array_reverse($inspections);
        return view('sitemanager::index', compact('inspections', 'branch'));
    }

    public function approvedInspections(){
        $inspections= array();
        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch;
        // dd($branch);
        $branch_users = $branch->users()->get();
        foreach($branch_users as $user){
            foreach($user->inspections as $inspection){
                if($inspection->approvedBy_hygiene ==1)
                    array_push($inspections, $inspection);
            }
        }
        $inspections = array_reverse($inspections);
        return view('sitemanager::approved-inspections', compact('inspections', 'branch'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sitemanager::create');
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
        return view('sitemanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sitemanager::edit');
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

    public function siteManagers(){
        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch;
        $users = $this->sitemanagers;
        return view('sitemanager::users' ,compact('users', 'branch'));
    }

    public function storeReview(Request $request){
        Validator::make($request->all(), [
            'comments'=> 'required',
            'inspection_id'=> 'required|integer'
         ]);
        
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['inspection_id'] = $request->inspection_id;

        $review = Review::create($data);
        Inspection::where('id', $request->inspection_id)->update(['approvedBy_siteman'=>0]);
        if($review)
            return redirect()->route('sitemanager')->with(['success'=>"Review created Successfully"]);
        else
            return redirect()->route('sitemanager')->with(['danger'=>"Sorry something went wrong!"]);
    }

    public function approve($id){
        $inspectionApproved = Inspection::where('id', $id)->update(['approvedBy_siteman'=>1]);
        if($inspectionApproved)
            return redirect()->route('sitemanager')->with(['success'=>"Approved Successfully"]);
        else
            return redirect()->route('sitemanager')->with(['danger'=>"Sorry something went wrong!"]);
    }

    public function reviewList($id){
        return Review::where('inspection_id', $id)->get();
    }

    public function general_users(){
        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch;
        $users = User::where('branch_id', Auth::user()->branch_id)->where('id', '!=', Auth::id())->get();
        return view('sitemanager::general-users' ,compact('users', 'branch'));
    }

    public function approveUser($id){
        $userFound = User::findOrFail($id)->first();
        $userApproved = User::where('id', $id)->update(['current_status'=>'approved']);
    
        if($userApproved)
            return redirect()->back()->with(['success'=>'User Approved successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function disapproveUser($id){
        $userFound = User::findOrFail($id)->first();
        $disapprovedUser = User::where('id', $id)->update(['current_status'=>'suspended']);
    
        if($disapprovedUser)
            return redirect()->back()->with(['success'=>'User Suspended successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function normalizeUser($id){
        $userFound = User::findOrFail($id)->first();
        $userNormalized = User::where('id', $id)->update(['current_status'=>'normal']);
    
        if($userNormalized)
            return redirect()->back()->with(['success'=>'User Normalized successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }

    public function deleteUser($id){
        $userFound = User::findOrFail($id)->first();
        $deleted = User::where('id', $id)->update(['status'=>1]);
    
        if($deleted)
            return redirect()->back()->with(['success'=>'User Deleted successfully!!!']);
        else
            return redirect()->route('senioroperationmanager.branch.detail', $userFound->branch_id)->with(['error'=>'Something went Wrong!!!']);
    }


    public function inspectionSubmittedPdf(){
        $inspections = Inspection::where('approvedBy_hygiene', 1)->where('approvedBy_siteman', 1)->where('user_id', Auth::id())->get();
        $title = 'Submitted';

        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch->name;

        $pdf = PDF::loadView('hygiene::reports.submitted-pdf', ['inspections' => $inspections, 'title' => $title, 'branch'=>$branch]);

        return $pdf->stream('inspection-submitted.pdf');
    }

    public function inspectionSubmittedExcel(){
        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch->name;
        return Excel::download(new InspectionsUnSubmittedExport($branch), 'submitted-inspections.xlsx');
    }

    public function inspectionUnSubmittedPdf(){
        $inspections = Inspection::where('approvedBy_hygiene', 1)->where('approvedBy_siteman', 0)->where('user_id', Auth::id())->get();
        $title = 'Submitted';

        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch->name;

        $pdf = PDF::loadView('hygiene::reports.submitted-pdf', ['inspections' => $inspections, 'title' => $title, 'branch'=>$branch]);

        return $pdf->stream('inspection-submitted.pdf');
    }

    public function inspectionUnSubmittedExcel(){
        $this->branch = $this->user->checkUserBranch(Auth::user()->branch_id);
        $branch = $this->branch->name;
        return Excel::download(new InspectionsUnSubmittedExport($branch), 'submitted-inspections.xlsx');
    }
    
}
