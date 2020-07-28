<?php

namespace App\Http\Controllers\Dashboard\UserEmails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use DataTables;

use App\Models\Role;

class UserEmailsController extends Controller
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
        return view('admin.user-emails.index');
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
        $users = User::select('profiles.last_name','profiles.first_name','users.id as user_id','users.email','users.email_created','users.role','useremails.id as useremail_id','useremails.email_password','useremails.lms_password','useremails.user_email')
                    ->join('profiles','profiles.id','=','users.profile_id')
                    ->leftjoin('useremails','useremails.user_id','=','users.id')
                    ->get();
        // dd($users);
        return DataTables::of($users)
                ->addColumn('type', function($data){
                    $roles = Role::all();
                    $type = '';
                    foreach($roles as $role){
                        if($role->code == $data->role){
                            $type = $role->role;
                        }
                    }
                    return $type;
                })
                ->addColumn('name', function($data){
                    $name = $data->first_name.' '.$data->last_name;
                    return $name;
                })
                ->addColumn('suggested_email', function($data){
                    return $data->email;
                })
                ->addColumn('created_email', function($data){
                    $createdEmail = 'Not Yet Created';
                    if($data->user_email){
                        $createdEmail = $data->user_email;
                    }
                    return $createdEmail;
                })
                ->addColumn('email_password', function($data){
                    $emailPassword = 'No Password Yet';
                    if($data->email_password){
                        $emailPassword = $data->email_password;
                    }
                    return $emailPassword;
                })
                ->addColumn('lms_password', function($data){
                    $lmsPassword = 'No Password Yet';
                    if($data->lms_password){
                        $lmsPassword = $data->lms_password;
                    }
                    return $lmsPassword;
                })
                ->addColumn('status', function($data){
                    $status = '<span class="badge badge-danger px-3 py-2">Not Yet Created</span>';
                    if($data->email_created == 1){
                        $status = '<span class="badge badge-success px-3 py-2">Created</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($data){
                    $viewBtn = '<a href="" data-id="'.$data->user_id.'" class="btn btn-sm btn-success viewStudent mr-1"><i class="fas fa-plus"></i> Create</a>';
                    $editBtn = '<a href="" data-id="'.$data->useremail_id.'" class="btn btn-sm btn-warning editEnrollment"><i class="fas fa-edit"></i> Edit</a>';
                    $actionBtn = $viewBtn . $editBtn;
                    if($data->user_email && $data->email_password && $data->lms_password){
                        $actionBtn = $editBtn; 
                    }                    
                    return $actionBtn;
                })
                ->rawColumns(['action','type','name','suggested_email','created_email','email_password','lms_password','status'])
                ->make(true);
    }
}
