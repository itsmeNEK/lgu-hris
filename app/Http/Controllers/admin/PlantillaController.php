<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Department;
use App\Models\admin\EmployeePlantilla;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PlantillaController extends Controller
{
    private $plantilla;
    private $department;
    private $user;
    public function __construct(EmployeePlantilla $plantilla, Department $department, User $user)
    {
        $this->plantilla = $plantilla;
        $this->department = $department;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $t_department = $this->department->paginate(5);
        $all_department = $this->department->get();
        $all_user = $this->user
        ->where('id', '!=', '1')
        ->where('role', '!=', '1')
        ->where('role', '!=', '6')->get();
        return view('hr.plantilla')
        ->with('t_department', $t_department)
        ->with('all_department', $all_department)
        ->with('edit_plan', null)
        ->with('edit_dep', null)
        ->with('all_user', $all_user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_department = $this->department->orderBy('dep_id')->get();
        return view('print.all_plantilla')
        ->with('all_department', $all_department);
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
            'EPno' => 'required|min:1|max:50',
            'EPposition' => 'required|min:1|max:50',
            'department' => 'required|max:50',
            'EPdesignation' => 'required|max:50',
        ]);
        $this->plantilla->EPno =  $request->EPno;
        $this->plantilla->EPposition =  strtoupper($request->EPposition);
        $this->plantilla->dep_id =   $request->department;
        $this->plantilla->EPdesignation =   $request->EPdesignation;
        $this->plantilla->status =   $request->status;
        if ($request->EPdesignation && $request->incumbent) {
            $this->plantilla->user_id =  $request->incumbent;
            $user = $this->user->findOrFail($request->incumbent);
            if ($user->role == 2 || $user->role == 1) {
                $user->role = "2";
                $user->save();
            }
        }

        if ($this->plantilla->save()) {
            Session::flash('alert', 'success|Record has been Saved');
            return redirect()->back();
        } else {
            Session::flash('alert', 'danger|Record not Save');
            return redirect()->back();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all_plantilla = $this->plantilla->orderBy('EPno', 'asc')->paginate(10);
        $t_department = $this->department->paginate(10);
        $all_department = $this->department->get();
        $plantilla = $this->plantilla->findOrFail($id);
        $all_user = $this->user->get();
        return view('hr.plantilla')
        ->with('all_plantilla', $all_plantilla)
        ->with('all_department', $all_department)
        ->with('t_department', $t_department)
        ->with('edit_plan', $plantilla)
        ->with('edit_dep', null)
        ->with('all_user', $all_user);
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
            'EPno' => 'required|min:1|max:50',
            'EPposition' => 'required|min:1|max:50',
            'department' => 'required|max:50',
            'EPdesignation' => 'required|max:50',
        ]);
        $plantilla =  $this->plantilla->findOrFail($id);
        ;
        $plantilla->EPno =  $request->EPno;
        $plantilla->EPposition =  strtoupper($request->EPposition);
        $plantilla->dep_id =   $request->department;
        $plantilla->EPdesignation =   $request->EPdesignation;
        $plantilla->status =   $request->status;
        if ($request->incumbent) {
            $plantilla->user_id =  $request->incumbent;
            $user = $this->user->findOrFail($request->incumbent);
            if ($user->role == 2 || $user->role == 1) {
                $user->role = "2";
                $user->save();
            }
        }

        if ($plantilla->save()) {
            Session::flash('alert', 'success|Record has been Saved');
            return redirect()->route('hr.plantilla.index');
        } else {
            Session::flash('alert', 'danger|Record not Save');
            return redirect()->back();
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

        $ids = explode(",", $id);

        if ($this->plantilla->destroy($ids)) {
            Session::flash('alert', 'success|Record has been Deleted');
            return response()->json(null, Response::HTTP_OK);
        } else {
            Session::flash('alert', 'danger|Record not Deleted');
            return response()->json(null, Response::HTTP_OK);
        }
    }
}
