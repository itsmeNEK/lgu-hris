<?php

namespace App\Http\Controllers\users\pds;

use App\Http\Controllers\Controller;
use App\Models\pds\voluntarywork as PdsVoluntarywork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VoluntaryWork extends Controller
{
    public const LOCAL_STORAGE_FOLDER = "pdsFiles/";
    public const LOCAL_STORAGE_FOLDER_DELETE = "/public/pdsFiles/";
    private $voluntarywork;

    public function __construct(PdsVoluntarywork $voluntarywork)
    {
        $this->voluntarywork = $voluntarywork;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voluntarywork = $this->voluntarywork->where('user_id', Auth::user()->id)->paginate(10);
        return view('users.PDS.voluntarywork')->with('voluntarywork', $voluntarywork)->with('edit_vol', null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'VWname'=>'required|min:1',
            'document'=>'max:8000|mimes:pdf',
        ], [
            'VWname.required' =>'Voluntary Work is Empty',
            'document.max' =>'File is to big',
            'document.mimes' =>'Invalid File type',
        ]);
        $this->voluntarywork->user_id = Auth::user()->id;
        $this->voluntarywork->VWname = strtoupper($request->VWname);
        $this->voluntarywork->VWidfrom = $request->VWidfrom;
        $this->voluntarywork->VWidto = $request->VWidto;
        $this->voluntarywork->VWNumHours = $request->VWNumHours;
        $this->voluntarywork->VWpostion = strtoupper($request->VWpostion);
        if ($request->document) {
            $this->voluntarywork->document = $this->saveFile($request->document);
        }
        if ($this->voluntarywork->save()) {
            Session::flash('alert', 'success|Record has been Save');
            return back();
        } else {
            Session::flash('alert', 'danger|Record not Updated');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voluntarywork = $this->voluntarywork->where('user_id', Auth::user()->id)->paginate(10);
        $edit_work = $this->voluntarywork->findOrFail($id);
        return view('users.PDS.voluntarywork')->with('voluntarywork', $voluntarywork)->with('edit_vol', $edit_work);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'VWname'=>'required|min:1',
            'document'=>'max:8000|mimes:pdf',
        ], [
            'VWname.required' =>'Voluntary Work is Empty',
            'document.max' =>'File is to big',
            'document.mimes' =>'Invalid File type',
        ]);
        $voluntarywork = $this->voluntarywork->findOrFail($id);
        $voluntarywork->VWname = strtoupper($request->VWname);
        $voluntarywork->VWidfrom = $request->VWidfrom;
        $voluntarywork->VWidto = $request->VWidto;
        $voluntarywork->VWNumHours = $request->VWNumHours;
        $voluntarywork->VWpostion = strtoupper($request->VWpostion);
        if ($request->document) {
            $voluntarywork->document = $this->saveFile($request->document);
        }

        if ($voluntarywork->save()) {
            Session::flash('alert', 'success|Record has been Save');
            return redirect()->route('users.pds.voluntarywork.index');
        } else {
            Session::flash('alert', 'danger|Record not Updated');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educ = $this->voluntarywork->findOrFail($id);
        if($educ->document) {
            $this->deleteFile($educ->document);
        }

        if ($this->voluntarywork->destroy($id)) {
            Session::flash('alert', 'success|Record has been Deleted');
            return back();
        } else {
            Session::flash('alert', 'danger|Record not Deleted');
            return back();
        }
    }

    public function saveFile($file)
    {
        // getting original name
        $filenameWithExt = $file->getClientOriginalName();

        //Get just the file name
        $filenameWithoutExy = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // creating new name
        $filename = $filenameWithoutExy."-".time()."-".Auth::user()->id.".". $file->extension();

        // getting file path
        $filename_path = self::LOCAL_STORAGE_FOLDER_DELETE . $filename;
        while (Storage::disk('local')->exists($filename_path)) {
            // creating new name while exist
            $filename = $filenameWithoutExy."-".time()."-".Auth::user()->id.".". $file->extension();
            $filename_path = self::LOCAL_STORAGE_FOLDER_DELETE . $filename;
        }

        $file->storeAs(self::LOCAL_STORAGE_FOLDER, $filename);

        return $filename;
    }

    public function deleteFile($filename)
    {
        $filename_path = self::LOCAL_STORAGE_FOLDER_DELETE . $filename;

        if (Storage::disk('local')->exists($filename_path)) {
            Storage::disk('local')->delete($filename_path);
        }
    }
}
