<?php

namespace App\Http\Controllers\Dashboard\Instructors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Validator;

use App\Models\Profile;
use App\User;

class InstructorsController extends Controller
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
        return view('admin.instructors.index');
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
            'instructor-id' => 'required',
            'last-name'     => 'required',
            'first-name'     => 'required',
            'email' => 'required',
            'status'        => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
            return response()->json([
                $error_array
            ],414);
        } else {
            
            // create instructor
            $instructor = new Profile;
            $instructor->school_id = $request->input('instructor-id');
            $instructor->profile_pic = 'No Data';
            $instructor->last_name = $request->input('last-name');
            $instructor->first_name = $request->input('first-name');
            $instructor->middle_name = 'No Data';
            $instructor->gender = 0;
            $instructor->civil_status = 0;
            $instructor->contact_number = '0';
            $instructor->email = $request->input('email');
            $instructor->religion = 'No Data';
            $instructor->purok = 'No Data';
            $instructor->sitio = 'No Data';
            $instructor->barangay = 'No Data';
            $instructor->municipality = 'No Data';
            $instructor->province = 'No Data';
            $instructor->zipcode = 0;
            $instructor->emergency_contact_name = 'No Data';
            $instructor->emergency_contact_number = 'No Data';
            $instructor->school_graduated = 'No Data';
            $instructor->year_graduated = 0;
            $instructor->school_address = 'No Data';
            $instructor->lrn = 0;
            $instructor->course = '0';
            $instructor->year_level = '0';
            $instructor->complete_profile = 0;
            $instructor->save();

            $user = new User;
            $user->email = $request->input('email');
            $user->password = Hash::make('WelcomeInstructor123!');
            $user->role = $request->input('status');
            $user->profile_id = $instructor->id;
            $user->password_changed = 0;
            $user->email_created = 0;
            $user->save();

            $success_output = [
                'profile' => $instructor,
                'user' => $user
            ];

            return response()->json([
                $success_output
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
        if(request()->ajax()){
            $instructor = Profile::where('profiles.id', $id)
                                ->join('users','profiles.id','=','users.profile_id')
                                ->select('profiles.*','users.role')
                                ->first();
            return response()->json($instructor);
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
            'instructor-id' => 'required',
            'last-name'     => 'required',
            'first-name'     => 'required',
            'email' => 'required',
            'status'        => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
            return response()->json([
                $error_array
            ],414);
        } else {
            
            // create instructor
            $instructor = Profile::where('id', $id)->first();
            $instructor->last_name = $request->input('last-name');
            $instructor->first_name = $request->input('first-name');
            $instructor->email = $request->input('email');
            $instructor->save();

            $user = User::where('profile_id',$id)->first();
            $user->name = $request->input('first-name').' '.$request->input('last-name');
            $user->email = $request->input('email');
            $user->role = $request->input('status');
            $user->profile_id = $instructor->id;
            $user->save();

            $success_output = [
                'profile' => $instructor,
                'user' => $user
            ];

            return response()->json([
                $success_output
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
        $instructors = Profile::where('role',4)->orWhere('role',5)->get();
        return DataTables::of($instructors)
                ->addColumn('status', function($data){
                    $status = '';

                    if($data->role === 4){
                        $status = '<span class="badge badge-pill badge-primary">Full-time</span>';
                    } else if($data->role === 5){
                        $status = '<span class="badge badge-pill badge-warning">Part-time</span>';
                    }

                    return $status;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-warning editInstructor">
                                        <i class="fas fa-edit"></i>
                                      </a>';
                                    //   <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteInstructor">
                                    //     <i class="fas fa-trash"></i>
                                    //   </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }

    public function instructorList()
    {
        if(request()->ajax()){
            $instructors = Profile::select('id','first_name','last_name')->where('role', 4)->orWhere('role',5)->get();
        }

        return response()->json($instructors);
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
