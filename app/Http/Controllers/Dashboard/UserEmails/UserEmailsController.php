<?php

namespace App\Http\Controllers\Dashboard\UserEmails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use DataTables;

use App\Models\Role;
use App\Models\UserEmail;
use Validator;

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
        $validation = Validator::make($request->all(),[
            'created_email' => 'required',
            'email_password' => 'required',
            'lms_password' => 'required',
            'user_id' => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
            return response()->json([
                'error' => $error_array,
            ],400);
        } else {
            
            // create User Email            
            $userEmail = new UserEmail;
            $userEmail->user_email = $request->input('created_email');
            $userEmail->email_password = $request->input('email_password');
            $userEmail->lms_password = $request->input('lms_password');
            $userEmail->user_id = $request->input('user_id');
            $userEmail->save();

            $createdEmail = User::where('id',$request->input('user_id'))->first();
            $createdEmail->email_created = 1;
            $createdEmail->save();

            if(!$userEmail->save()){
                return response()->json([
                    'error' => $userEmail,
                ],400);
            }

            return response()->json([
                'success' => 'User Email Added!',
                'data' => $userEmail
            ],200);
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
        $user = User::where('users.id',$id)
                    ->join('profiles','users.profile_id','=','profiles.id')
                    ->join('roles','users.role','=','roles.code')
                    ->select('users.id as user_id','users.email as suggested_email','profiles.last_name','profiles.first_name','roles.role')
                    ->first();
        // dd($user);
        if($user->count() > 0){
            return response()->json([
                'user' => $user
            ],200);
        } else {
            return response()->json([
                'error' => 'No User Found!'
            ],400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = UserEmail::where('useremails.user_id',$id)
                    ->join('users','useremails.user_id','=','users.id')
                    ->join('profiles','users.profile_id','=','profiles.id')
                    ->join('roles','users.role','=','roles.code')
                    ->select('users.id as user_id','users.email as suggested_email','profiles.last_name','profiles.first_name','roles.role','useremails.user_email','useremails.email_password','useremails.lms_password')
                    ->first();
        // dd($user);
        if($user->count() > 0){
            return response()->json([
                'user' => $user
            ],200);
        } else {
            return response()->json([
                'error' => 'No User Found!'
            ],400);
        }
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
        $validation = Validator::make($request->all(),[
            'created_email' => 'required',
            'email_password' => 'required',
            'lms_password' => 'required',
            'user_id' => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
            return response()->json([
                'error' => $error_array,
            ],400);
        } else {
            
            // update User Email
            $userEmail = UserEmail::where('user_id',$request->input('user_id'))->first();
            $userEmail->user_email = $request->input('created_email');
            $userEmail->email_password = $request->input('email_password');
            $userEmail->lms_password = $request->input('lms_password');
            $userEmail->user_id = $request->input('user_id');
            $userEmail->save();

            $createdEmail = User::where('id',$request->input('user_id'))->first();
            $createdEmail->email_created = 1;
            $createdEmail->save();

            if(!$userEmail->save()){
                return response()->json([
                    'error' => $userEmail,
                ],400);
            }

            return response()->json([
                'success' => 'User Email Updated!',
                'data' => $userEmail
            ],200);
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
        //
    }

    public function generateDatatables()
    {
        $users = User::select('profiles.last_name','profiles.first_name','users.id as user_id','users.email','users.email_created','users.role','useremails.id as useremail_id','useremails.email_password','useremails.lms_password','useremails.user_email','useremails.status')
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
                    $createdEmail = 'None';
                    if($data->user_email){
                        $createdEmail = $data->user_email;
                    }
                    return $createdEmail;
                })
                ->addColumn('email_password', function($data){
                    $emailPassword = 'None';
                    if($data->email_password){
                        $emailPassword = $data->email_password;
                    }
                    return $emailPassword;
                })
                ->addColumn('lms_password', function($data){
                    $lmsPassword = 'None';
                    if($data->lms_password){
                        $lmsPassword = $data->lms_password;
                    }
                    return $lmsPassword;
                })
                ->addColumn('status', function($data){
                    $status = '<span class="badge badge-danger px-3 py-2">Not Yet</span>';
                    if($data->email_created == 1){
                        $status = '<span class="badge badge-success px-3 py-2">Created</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($data){
                    $createBtn = '<a href="" data-id="'.$data->user_id.'" class="btn btn-sm btn-success createUserEmail mr-1"><i class="fas fa-plus"></i> Create</a>';
                    $editBtn = '<a href="" data-id="'.$data->user_id.'" class="btn btn-sm btn-warning editUserEmail"><i class="fas fa-edit"></i> Edit</a>';
                    $btnActivateColor = '';
                    if($data->status == '1'){
                        $btnActivateColor = 'btn-danger';
                    } else {
                        $btnActivateColor = 'btn-primary';
                    }
                    $btnActivate = '<a href="" data-id="'.$data->user_id.'" class="btn btn-sm '.$btnActivateColor.' activateCredentials"><i class="fas fa-power-off"></i></a>';
                    $actionBtn = $createBtn;
                    if($data->user_email && $data->email_password || $data->user_email && $data->lms_password){
                        $actionBtn = $btnActivate . $editBtn; 
                    }                    
                    return $actionBtn;
                })
                ->rawColumns(['action','type','name','suggested_email','created_email','email_password','lms_password','status'])
                ->make(true);
    }

    public function activate($id)
    {
        $userEmail = UserEmail::where('user_id',$id)->first();
        $userEmail->status = '1';
        $userEmail->save();
        
        if($userEmail->save()){
            return response()->json([
                'success' => 'User Email Activated!',
                'data' => $userEmail
            ],200);
        } else {
            return response()->json([
                'error' => $userEmail->save()
            ],400);
        }
    }
}
