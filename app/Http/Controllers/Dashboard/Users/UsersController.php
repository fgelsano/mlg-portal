<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Validator;
use App\User;

class UsersController extends Controller
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
        return view('admin.users.index');
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
        $users = User::select('profiles.profile_pic','users.id','users.name','users.email','users.role')
                    ->join('profiles','users.profile_id','=','profiles.id')->get();
        // dd($users->all());
        return DataTables::of(User::latest()->get())
                ->addColumn('role', function($data){
                    $role = '';
                    if($data->role == 0){
                        $role = 'Super Admin';
                    } else if($data->role == 1){
                        $role = 'Registrar';
                    } else if($data->role == 2){
                        $role = 'Cashier';
                    } else if($data->role == 3){
                        $role = 'Student';
                    } else if($data->role == 4){
                        $role = 'Fulltime Instructor';
                    } else if($data->role == 5){
                        $role = 'Parttime Instructor';
                    } else if($data->role == 6){
                        $role = 'Parent';
                    } else if($data->role == 7){
                        $role = 'School Administrator';
                    }
                    return $role;
                })
                ->addColumn('profile_pic', function($data){
                    if($data->profile_pic == NULL){
                        return $profilePic = '<div class="profile-pic" style="background-image: url(/admin/img/empty-profile-img.png)"></div>';
                    }
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-warning editSubject">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteSubject">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','profile_pic'])
                ->make(true);
    }
}
