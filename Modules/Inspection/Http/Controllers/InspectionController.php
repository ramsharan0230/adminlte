<?php

namespace Modules\Inspection\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Auth;
use PDF;

use Modules\Inspection\Entities\Inspection;
use Modules\Picture\Entities\Picture;
use Modules\Review\Entities\Review;
use Illuminate\Support\Str;
use Modules\Branch\Entities\Branch;
use Maatwebsite\Excel\Facades\Excel;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $inspections = Inspection::whereStatus(1)->where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        return view('inspection::index', compact('inspections'));
    }

    public function branch()
    {
        return Branch::where('id', Auth::user()->branch_id)->first();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // dd(23);
        $findings = Inspection::whereStatus(1)->select('findings')->distinct('findings')->get();
        $locations = Inspection::whereStatus(1)->select('location')->distinct('location')->get();
        $pcas = Inspection::whereStatus(1)->select('pca')->distinct('pca')->get();
        $accountibilities = Inspection::whereStatus(1)->select('accountibility')->distinct('accountibility')->get();

        return view('inspection::create', compact(['findings', 'locations', 'pcas', 'accountibilities']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // dd($request->upload_ins);
        
        Validator::make($request->all(), [
            'location'=> 'required|max:199',
            'findings'=> 'required|max:2500',
            'pca'=> 'required|max:2500',
            'accountibility'=> 'required',
            'start_date'=> 'required',
            'closing_date'=> 'required',
            "upload_ins"    => "sometimes|array",
            "upload_ins.*"  => "sometimes|distinct|mimes:jpeg,bmp,png,jpg",
         ]);
        
        $data = $request->all();
        $data['status'] = $request->publish?1:0;
        $data['user_id'] = Auth::id();
        $data['branch_id'] = Auth::user()->branch_id;

        $inspection = Inspection::create($data);
        if($inspection){
            // dd($inspection->id);
            // upload image
            foreach($request->upload_ins as $picture){
                $fileName = time().'.'.$picture->extension();  
                $picture->move(public_path('images/inspection_file/pictures'), $fileName);

                $picture = new Picture();
                $picture->name = $fileName;
                $picture->inspection_id = $inspection->id;
                $picture->save();
            }

            return redirect()->route('hygiene')->with(['success'=>"Inspection created Successfully"]);
        }
        else
            return redirect()->route('hygiene')->with(['danger'=>"Sorry something went wrong!"]);

    }

    public function addPicture(){
        return view('inspection::showCam');
    }


    public function storePicture(Request $request){
        // return "one";
        $request->validate([
            'picture' => 'required|min:1000',
            'id' => 'required'
        ]);
        $data = $request->all();

        if($request->picture){
            $image = $request->picture; 
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10).'.'.'jpeg';
            \File::put(public_path('images/inspection_file/pictures'). '/' . $imageName, base64_decode($image));
        }
        $data['picture'] = $imageName;
        $id = $request->id;

        $picture = new Picture();
        $picture->name = $imageName;
        $picture->inspection_id = $id;
        $picture->save();

        if($picture)
            return response()->json(['message' => 'Successfully updated Picture', 'status' => 200]);
    }

    public function getSliderImages($id){
        $data = Picture::where('inspection_id', $id)->get();

        return response()->json(['data' => $data, 'state' => 200]);
    }
    public function show($id)
    {
        return view('inspection::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('inspection::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        //
        Validator::make($request->all(), [
            'editInspectionId' =>'required|integer',
            'location'=> 'required|max:199',
            'findings'=> 'required|max:2500',
            'pca'=> 'required|max:2500',
            'accountibility'=> 'required',
            'start_date'=> 'required',
            'closing_date'=> 'required',
            "upload_ins"    => "sometimes|array",
            "upload_ins.*"  => "sometimes|distinct|mimes:jpeg,bmp,png,jpg"
         ]);
        $data = $request->except(['editInspectionId', '_token', 'upload_ins']);
        $data['status'] = $request->status;

        $inspection = Inspection::where('id', $request->editInspectionId)->update($data);
        if($inspection){
            foreach($request->upload_ins as $picture){
                $fileName = time().'.'.$picture->extension();  
                $picture->move(public_path('images/inspection_file/pictures'), $fileName);

                $picture = new Picture();
                $picture->name = $fileName;
                $picture->inspection_id = $request->editInspectionId;
                $picture->save();
            }
            return redirect()->route('hygiene')->with(['success'=>"Inspection updated Successfully"]);

        }
        else
            return redirect()->route('hygiene')->with(['danger'=>"Sorry something went wrong!"]);
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

    public function reviewList($id){
        return Review::where('inspection_id', $id)->orderBy('created_at', 'desc')->where('status', 1)->get();
    }

    public function approve($id){
        $inspectionApproved = Inspection::where('id', $id)->update(['approvedBy_hygiene'=>1]);
        if($inspectionApproved)
            return redirect()->route('hygiene')->with(['success'=>"Approved Successfully"]);
        else
            return redirect()->route('hygiene')->with(['danger'=>"Sorry something went wrong!"]);
    }

    public function findInspection($id){
        $inspection = Inspection::where('id', $id)->with('pictures')->first();
        return response()->json(['message' => 'Successful', 'status' => 200, 'payload'=> $inspection]);
    }

    public function delete($id){
        $deleteStatus = Inspection::where('id', $id)->delete();
        Review::where('inspection_id', $id)->update(['status'=>0]);

        return redirect()->route('hygiene')->with(['message'=>'Deleted Successfully', 'status'=>$deleteStatus]);
    }

    public function inspectionSubmittedExcel(){
        return Excel::download(new InspectionsExport, 'submitted-inspections.xlsx');
    }

    public function inspectionReport($branch_id){
        // dd($branch_id);
        return view('inspection::pdf.report', compact('branch_id'));
    }

    public function inspectionReportPdf(Request $request){
        $branch = Branch::findOrFail($request->branch_id);
        $inspections = Inspection::where('branch_id', $request->branch_id)
            ->whereBetween('created_at', [$request->start_date, $request->end_date])->get();

        $pdf = PDF::loadView('hygiene::reports.submitted-pdf', ['inspections' => $inspections, 'branch'=>$branch->name, 
        
        'start_date'=>$request->start_date, 'end_date'=>$request->end_date]);

        return $pdf->stream('inspection-submitted.pdf');
    }

    public function inspectionReportExcel($branch_id){
        return view('inspection::excel.report', compact('branch_id'));
    }

    public function inspectionReportExcelStream(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $branch_id = $request->branch_id;

        return Excel::download(new \Modules\Hygiene\Exports\InspectionsExport($start_date, $end_date, $branch_id), 'submitted-inspections.xlsx');
    }

}
