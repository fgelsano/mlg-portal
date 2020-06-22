<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Validator;
use App\User;

use Illuminate\Support\Facades\Hash;
use App\Models\Profile;

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
        $validation = Validator::make($request->all(),[
            'first-name'  => 'required',
            'last-name'   => 'required',
            'user-email'  => 'required',
            'user-role'   => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()->toArray(),
            ],400);
        } else {
            
            $profile = new Profile;
            $profile->first_name = $request->input('first-name');
            $profile->last_name = $request->input('last-name');
            $profile->role = $request->input('user-role');
            $profile->email = $request->input('user-email');
            $profile->complete_profile = '0';
            
            $profile->school_id = 'No Data';
            $profile->middle_name = 'No Data';
            $profile->gender = 0;
            $profile->civil_status = 0;
            $profile->contact_number = 'No Data';
            $profile->religion = 'No Data';
            $profile->purok = 'No Data';
            $profile->sitio = 'No Data';
            $profile->barangay = 'No Data';
            $profile->municipality = 'No Data';
            $profile->province = 'No Data';
            $profile->zipcode = 0;
            $profile->emergency_contact_name = 'No Data';
            $profile->emergency_contact_number = 'No Data';
            $profile->school_graduated = 'No Data';
            $profile->year_graduated = 0;
            $profile->school_address = 'No Data';
            $profile->lrn = 0;
            $profile->course = 0;
            $profile->year_level = 0;
            $profile->complete_profile = 0;
            $profile->dpa_agreement = 0;

            $now = new \DateTime('NOW');
            $date = $now->format('m-d-Y_H.i.s');
            if($request->has('profile-pic')){
                $profile_pic_WithExt = $request->file('profile-pic')->getClientOriginalName();
                $profile_pic_filename = pathinfo($profile_pic_WithExt, PATHINFO_FILENAME);
                $profile_pic_extension = $request->file('profile-pic')->getClientOriginalExtension();
                $profile_pic = str_replace(' ','_',$profile_pic_filename.'-'.$date.'.'.$profile_pic_extension);
                $path_profile_pic = $request->file('profile-pic')->storeAs('public/uploads/applicant-img', $profile_pic);
                $profile->profile_pic = $profile_pic;
            } else {
                $profile->profile_pic = 'No Data';
            }
            $profile->save();

            $user = new User;
            $user->email = $request->input('user-email');
            $user->password = Hash::make('Welcome123!');
            $user->role = $request->input('user-role');
            $user->profile_id = $profile->id;
            $user->password_changed = 0;
            $user->email_created = 0;
            $user->save();

            if(!$user->save()){
                return response()->json([
                    'user-error' => $user,
                ],400);
            }

            if(!$profile->save()){
                return response()->json([
                    'profile-error' => $profile
                ],400);
            }

            return response()->json([
                'success' => 'User '.$request->input('first-name').' '.$request->input('last-name').' Added!',
                'user' => $user,
                'profile' => $profile
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
                    ->select('profiles.first_name','profiles.last_name','users.id','users.email','users.role','profiles.profile_pic')
                    ->first();
        // dd($user);
        return response()->json([
            'user' => $user
        ],200);
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
        $validation = Validator::make($request->all(),[
            'first-name'  => 'required',
            'last-name'   => 'required',
            'user-email'  => 'required',
            'user-role'   => 'required'
        ]);

        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()->toArray(),
            ],400);
        } else {
            
            $profileId = User::where('id',$request->input('user-id'))->select('profile_id')->first();
            $user = User::where('id',$request->input('user-id'))->first();
            $user->email = $request->input('user-email');
            $user->role = $request->input('user-role');
            $user->save();

            if(!$user->save()){
                return response()->json([
                    'user-error' => $user,
                ],400);
            }
           
            $profile = Profile::where('id',$profileId->profile_id)->first();
            $profile->first_name = $request->input('first-name');
            $profile->last_name = $request->input('last-name');

            
            $now = new \DateTime('NOW');
            $date = $now->format('m-d-Y_H.i.s');
            if($request->has('profile-pic')){
                $profile_pic_WithExt = $request->file('profile-pic')->getClientOriginalName();
                $profile_pic_filename = pathinfo($profile_pic_WithExt, PATHINFO_FILENAME);
                $profile_pic_extension = $request->file('profile-pic')->getClientOriginalExtension();
                $profile_pic = str_replace(' ','_',$profile_pic_filename.'-'.$date.'.'.$profile_pic_extension);
                $path_profile_pic = $request->file('profile-pic')->storeAs('public/uploads/applicant-img', $profile_pic);
                $profile->profile_pic = $profile_pic;
            } 
            $profile->save();

            if(!$profile->save()){
                return response()->json([
                    'profile-error' => $profile
                ],400);
            }

            return response()->json([
                'success' => 'User '.$request->input('first-name').' '.$request->input('last-name').' Updated!',
                'user' => $user,
                'profile' => $profile
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
        $users = User::select('profiles.profile_pic','users.id','profiles.first_name','profiles.last_name','users.email','users.role','users.created_at')
                    ->join('profiles','users.profile_id','=','profiles.id')
                    ->get();
        return DataTables::of($users)
                ->addColumn('name', function($data){
                    $name = '';
                    $name = $data->first_name.' '.$data->last_name;
                    return $name;
                })
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
                        $role = 'Full Time Instructor';
                    } else if($data->role == 5){
                        $role = 'Part Time Instructor';
                    } else if($data->role == 6){
                        $role = 'Parent';
                    } else if($data->role == 7){
                        $role = 'School Administrator';
                    }
                    return $role;
                })
                ->addColumn('profile_pic', function($data){
                    if($data->profile_pic == 'none'){
                        return $profilePic = '<div class="profile-pic" style="background-image: url(/admin/img/empty-profile-img.png)"></div>';
                    } else {
                        $profilePic = '<div class="profile-pic" style="background-image: url(/storage/uploads/applicant-img/'.$data->profile_pic.')"></div>';
                    }
                    return $profilePic;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-warning editUser">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteUser">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','profile_pic'])
                ->make(true);
    }

    public function resetPassword(Request $request)
    {
        if($request->input('password') == $request->input('password-confirmation')){
            // dd($request->all());
            $user = User::where('profile_id',$request->input('userId'))->first();
            // dd($user);
            $user->password = Hash::make($request->input('password'));
            $user->password_changed = 1;
            $user->save();
            return response()->json(
                $user
            ,200);
        }         
    }
}
