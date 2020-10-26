<?php

namespace App\Http\Controllers\Dashboard\Instructors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Clearance;
use App\Models\Option;

use Validator;
use Redirect;

class ClearStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request->input('studentId')){
            $validation = Validator::make($request->all(),[
                'subjectId' => 'required',
                'studentId'     => 'required',
                'action'     => 'required'
            ]);
    
            $error_array = array();
            $success_output = '';
            $ay = Option::where('type','current-ay')->select('id')->first();
            $sem = Option::where('type','current-sem')->select('id')->first();
            
            if($validation->fails()){
                foreach($validation->messages()->getMessages() as $field_name => $messages){
                    $error_array[] = $messages;
                }
                return response()->json([
                    $error_array
                ],414);
            } else {
                if($request->input('action') == 'Approve'){
                    // Create Clearance
                    $checkIfStudentIdIsArray = is_Array($request->input('studentId'));
                    if($checkIfStudentIdIsArray){
                        foreach($request->input('studentId') as $student){
                            $checkIfExists = Clearance::where('subjectId',$request->input('subjectId'))->where('studentId',$student)->first();
                            if(!$checkIfExists){
                                $cleared = new Clearance;
                                $cleared->subjectId = $request->input('subjectId');
                                $cleared->studentId = $student;
                                $cleared->ay = $ay->id;
                                $cleared->sem = $sem->id;
                                $cleared->save();
                            }
                        }
                    } else {
                        $cleared = new Clearance;
                        $cleared->subjectId = $request->input('subjectId');
                        $cleared->studentId = $request->studentId;
                        $cleared->ay = $ay->id;
                        $cleared->sem = $sem->id;
                        $cleared->save();
                    }
                    return response()->json([
                        $cleared
                    ],200);
                } else {
                    // Update Clearance
                    $checkIfStudentIdIsArray = is_Array($request->input('studentId'));
                    if($checkIfStudentIdIsArray){
                        foreach($request->input('studentId') as $student){
                            $cleared = Clearance::where('studentId',$student)->where('subjectId',$request->input('subjectId'))->first();
                            if($cleared){
                                $cleared->delete();
                            }
                        }
                    } else {
                        $cleared = Clearance::where('studentId',$request->studentId)->where('subjectId',$request->subjectId)->first();
                    }

                    return response()->json([
                        $cleared
                    ],200);
                }
            }
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
        $subject = Subject::where('id',$id)->select('id','code')->first();
        $clearances = Enrollment::where('enrollments.subject_id',$id)
                                ->join('profiles','enrollments.profile_id','=','profiles.id')
                                ->join('courses','profiles.course','=','courses.id')
                                ->leftjoin('clearances',function($join){
                                    $join->on('clearances.subjectId','=','enrollments.subject_id')
                                         ->on('clearances.studentId','=','enrollments.profile_id');
                                })
                                ->select('profiles.id','profiles.school_id','profiles.last_name','profiles.first_name','profiles.year_level','profiles.gender','courses.code','clearances.id as clearanceId')
                                ->get();
        
        return view('admin.instructor-view.clearances.sections.student-roster', compact('clearances','subject'));
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
}
