<?php

namespace Modules\Inspection\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Auth;
use Modules\Inspection\Entities\Inspection;
use Modules\Picture\Entities\Picture;
use Illuminate\Support\Str;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $inspections = Inspection::whereStatus(1)->where('user_id', Auth::id())->get();
        return view('inspection::index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inspection::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'location'=> 'required|max:199',
            'findings'=> 'required|max:2500',
            'pca'=> 'required|max:2500',
            'accountibility'=> 'required',
            'start_date'=> 'required',
            'closing_date'=> 'required'
         ]);
        
        $data = $request->all();
        $data['status'] = $request->publish?1:0;
        $data['user_id'] = Auth::id();

        $inspection = Inspection::create($data);
        if($inspection)
            return redirect()->route('inspection')->with(['success'=>"Inspection created Successfully"]);
        else
            return redirect()->route('inspection')->with(['danger'=>"Sorry something went wrong!"]);

    }

    public function addPicture(){
        return view('inspection::showCam');
    }


    public function storePicture(Request $request){
        // return "one";
        // return dd($request->all());
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
}
