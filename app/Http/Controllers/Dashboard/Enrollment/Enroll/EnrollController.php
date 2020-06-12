<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Enroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use DataTables;

use App\Models\Enrollee;
use App\Models\Profile;
use App\Models\Admission;

class EnrollController extends Controller
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
        return view('admin.enrollment.enrollees');
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
            'enrolledSubject'     => 'required',
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            if(is_array($request->input('enrolledSubject'))){
                foreach($request->input('enrolledSubject') as $subject){
                    $enrollee = new Enrollee;
                    $enrollee->subject_id = $subject;
                    $enrollee->profile_id = $request->input('applicant_id');
                    $enrollee->save();
                }
            } else {
                $enrollee = new Enrollee;
                $enrollee->subject_id = $request->input('enrolledSubject');
                $enrollee->profile_id = $request->input('applicant_id');
                $enrollee->save();
            }

            $profile = Admission::where('id', $request->input('applicant_id'))->first();
            $profile->status = '5';
            $profile->save();

            $success_output = '<p class="m-0">Applicant Enrolled!</p>';
        }

        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );

        return response()->json($output);
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
            $instructor = Profile::where('id', $id)->first();
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
            'enrolledSubject'     => 'required',
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            if(is_array($request->input('enrolledSubject'))){
                foreach($request->input('enrolledSubject') as $subject){
                    $enrollee = new Enrollee;
                    $enrollee->subject_id = $subject;
                    $enrollee->profile_id = $request->input('applicant_id');
                    $enrollee->save();
                }
            } else {
                $enrollee = new Enrollee;
                $enrollee->subject_id = $request->input('enrolledSubject');
                $enrollee->profile_id = $request->input('applicant_id');
                $enrollee->save();
            }

            $profile = Profile::where('id', $request->input('applicant_id'))->first();
            $profile->status = '5';
            $profile->save();

            $success_output = '<p class="m-0">Applicant Enrolled!</p>';
        }

        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );

        return response()->json($output);
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
        $enrollees = Admission::where('status','5')->get();
        return DataTables::of($enrollees)
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

    public function instructorList()
    {
        if(request()->ajax()){
            $instructors = Profile::select('id','first_name','last_name')->where('type', '1')->get();
        }

        return response()->json($instructors);
    }
}
