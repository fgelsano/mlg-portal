<?php

namespace App\Http\Controllers\Dashboard\Profiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use App\Models\Profile;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            return $this->generateDatatables();
        };
        return view('admin.profiles.index');
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generateDatatables()
    {
        $profiles = Profile::where('role','!=',0)->select('first_name','last_name','role','school_id','id as profile_id','created_at')->get();
        // dd($profiles->all());
        return DataTables::of($profiles)
                ->addColumn('role', function($data){
                    $role = '';
                    // 0=admin, 1=registrar, 2=cashier, 3=student, 4=instructor_fulltime, 5=instructor_parttime, 6=parent
                    if($data->role == 1){
                        $role = 'Registrar';
                    } else if($data->role == 2){
                        $role = 'Cashier';
                    } else if($data->role == 3){
                        $role = 'Student';
                    } else if($data->role == 4){
                        $role = 'Full-time Instructor';
                    } else if($data->role == 5){
                        $role = 'Part-time Instructor';
                    } else if($data->role == 6){
                        $role = 'Parent';
                    } else if($data->role == 7){
                        $role = 'School Administrator';
                    }

                    return $role;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-warning editInstructor">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteInstructor">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }
}
