<?php

namespace Modules\SiteManager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inspection\Entities\Inspection;
use Modules\User\Entities\User;
use Modules\Review\Entities\Review;
use Validator;
use Auth;

class SiteManagerController extends Controller
{

    private $sitemanagers;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->sitemanagers = $user->siteManagers();
        // dd($user->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get());
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $inspections = Inspection::all();
        return view('sitemanager::index', compact('inspections'));
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
        $users = $this->sitemanagers;
        return view('sitemanager::users' ,compact('users'));
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
        // dd(Auth::user()->branch_id);
        $users = User::where('branch_id', Auth::user()->branch_id)->where('id', '!=', Auth::id())->get();
        return view('sitemanager::general-users' ,compact('users'));
    }
}
