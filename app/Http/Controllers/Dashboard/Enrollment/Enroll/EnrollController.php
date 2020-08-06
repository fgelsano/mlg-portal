<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Enroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;

use App\Models\Enrollment;
use App\Models\Profile;
use App\Models\Admission;
use App\Models\Subject;
use App\Models\Option;
use App\Models\Billing;
use App\User;

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
        return view('admin.enrollment.enrollees.index');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd(is_array(explode(',',$request->input('enrolledSubject'))));
        $validation = Validator::make($request->all(),[
            'enrolledSubject'     => 'required',
        ]);

        $currentAY = Option::where('type','current-ay')->select('id')->first();
        $currentSem = Option::where('type','current-sem')->select('id')->first();

        // dd($currentAY, $currentSem);

        $error_array = array();        
        $studentDetails = Profile::select('school_id','course','year_level')->where('id',$request->applicant_id)->first();
        // dd($request->applicant_id, $studentDetails);
        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
            return response()->json([
                $error_array
            ],414);
        } else {
            $schoolId = $studentDetails->school_id;
            
            if($schoolId == 'No Data'){
                $currentSchoolId = Profile::where('school_id','<>','No Data')->orderBy('school_id','desc')->get();
                
                $explodedId = explode('-',$currentSchoolId[1]->school_id);
                
                $incrementId = $explodedId[1]+1;
                $year = date('Y')%100;
                $schoolId = $year.'-'.str_pad($incrementId,6,'0', STR_PAD_LEFT);
            }
            
            if($request->action == 'enroll'){
                $subjectExists = [];    
                $lecture_units = 0;
                $laboratory_units = 0;
                $subjectsToEnroll = explode(',',$request->input('enrolledSubject'));
                foreach($subjectsToEnroll as $subjectToEnroll){
                    $existingSubjects = Enrollment::where('profile_id',$request->input('applicant_id'))->where('subject_id',$subjectToEnroll)->first();
                    // dd($existingSubjects);
                    if($existingSubjects <> null){
                        $subjectExists[] = $existingSubjects->subject_id;
                    } else {
                        $enrollee = new Enrollment;
                        $enrollee->subject_id = $subjectToEnroll;
                        $enrollee->profile_id = $request->input('applicant_id');
                        $enrollee->course = $studentDetails->course;
                        $enrollee->year_level = $studentDetails->year_level;
                        $enrollee->academic_year = $currentAY->id;
                        $enrollee->semester = $currentSem->id;
                        $enrollee->status = 0;
                        $enrollee->save();
                    }

                    $unitType = Subject::where('id',$subjectToEnroll)->select('type','units')->first();
                    if($unitType->type == '0'){
                        $lecture_units = $lecture_units + $unitType->units;
                    } else {
                        $laboratory_units = $laboratory_units + $unitType->units;
                    }
                }
                // dd('Lecture: '.$lecture_units, 'Laboratory: '.$laboratory_units);
                if(empty($subjectExists)){
                    $enroll = Admission::where('profile_id', $request->input('applicant_id'))->first();
                    $enroll->status = '4';
                    $enroll->save();

                    $profile = Profile::where('id',$request->input('applicant_id'))->first();
                    $profile->school_id = $schoolId;
                    $profile->save();

                    $user = new User;
                    $origfname = strtolower(str_replace(' ','.',$profile->first_name));
                    $firstLetter = explode('.',$origfname);
                    $fname = '';
                    foreach($firstLetter as $fLetter){
                        $fname = $fname . substr($fLetter,0,1);
                    }   
                    $lname = strtolower(str_replace(' ','.',$profile->last_name));                
                    $user->email = $fname.'.'.$lname.'@mlgcl.edu.ph';

                    $user->password = Hash::make($profile->school_id);
                    $user->role = 3;
                    $user->profile_id = $profile->id;
                    $user->save();

                    $fees = Option::where('type','fees')->get();
                    
                    foreach($fees as $fee){
                        if($fee->name == 'A. Lecture Tuition'){
                            $bill = new Billing;
                            $bill->admission_id = $enroll->id;
                            $bill->fee = $fee->name;
                            $bill->amount = $lecture_units * $fee->extra;
                            $bill->save();
                        } else if($fee->name == 'A. Laboratory Tuition'){
                            $bill = new Billing;
                            $bill->admission_id = $enroll->id;
                            $bill->fee = $fee->name;
                            $bill->amount = $laboratory_units * $fee->extra;
                            $bill->save();
                        } else {
                            $bill = new Billing;
                            $bill->admission_id = $enroll->id;
                            $bill->fee = $fee->name;
                            $bill->amount = $fee->extra;
                            $bill->save();
                        }
                        
                    }

                    return response()->json([
                        'enrolment' => $enrollee,
                        'admission' => $enroll,
                        'profile' => $profile,
                        'user' => $user
                    ],200);
                } else {
                    $subjects = Subject::select('id','code')->get();
                    return response()->json([
                        $subjectExists,
                        $subjects,
                    ],400);
                }
            } else if($request->action == 'editEnrollment') { // ### ELSE SECTION ### //
                $enrolled = [];
                $removed = [];
                // dd($request->input('removedSubjects'));
                if(($request->input('removedSubjects') != null)){
                    // dd($request->input('removedSubjects'));
                    $removeSubjects = explode(',',$request->input('removedSubjects'));
                    $enrolledSubjects = Enrollment::where('profile_id',$request->applicant_id)->get();
                    // dd($enrolledSubjects->all());
                    foreach($enrolledSubjects as $enrolledSubject){
                        if(in_array($enrolledSubject->subject_id,$removeSubjects)){
                            $remove = Enrollment::where('profile_id',$request->applicant_id)->where('subject_id',$enrolledSubject->subject_id)->delete();
                            $removed[] = $enrolledSubject->subject_id;
                        }
                    }
                }                
                if(($request->input('enrolledSubject') != null)){
                    // dd($request->input('enrolledSubject'));
                    $enrollSubjects = explode(',',$request->input('enrolledSubject'));
                    $existingSubjects = Enrollment::where('profile_id',$request->input('applicant_id'))->get();
                    // dd($existingSubjects);
                    if($existingSubjects->count() > 0){
                        $lecture_units = 0;
                        $laboratory_units = 0;
                        foreach($enrollSubjects as $enrollSubject){
                            if(!$existingSubjects->contains('subject_id',$enrollSubject)){
                                $enrollee = new Enrollment;
                                $enrollee->subject_id = $enrollSubject;
                                $enrollee->profile_id = $request->input('applicant_id');
                                $enrollee->course = $studentDetails->course;
                                $enrollee->year_level = $studentDetails->year_level;
                                $enrollee->status = 0;
                                $enrollee->save();
                                $enrolled[] = $enrollee->subject_id;
                            }   
                            $unitType = Subject::where('id',$enrollSubject)->select('type','units')->first();
                            if($unitType->type == '0'){
                                $lecture_units = $lecture_units + $unitType->units;
                            } else {
                                $laboratory_units = $laboratory_units + $unitType->units;
                            }                        
                        }

                        $enroll = Admission::where('profile_id', $request->input('applicant_id'))->first();
                        $fees = Option::where('type','fees')->get();
                    
                        foreach($fees as $fee){
                            if($fee->name == 'A. Lecture Tuition'){
                                $bill = new Billing;
                                $bill->admission_id = $enroll->id;
                                $bill->fee = $fee->name;
                                $bill->amount = $lecture_units * $fee->extra;
                                $bill->save();
                            } else if($fee->name == 'A. Laboratory Tuition'){
                                $bill = new Billing;
                                $bill->admission_id = $enroll->id;
                                $bill->fee = $fee->name;
                                $bill->amount = $laboratory_units * $fee->extra;
                                $bill->save();
                            } else {
                                $bill = new Billing;
                                $bill->admission_id = $enroll->id;
                                $bill->fee = $fee->name;
                                $bill->amount = $fee->extra;
                                $bill->save();
                            }
                        }
                    } else {
                        // dd('Null');
                        $lecture_units = 0;
                        $laboratory_units = 0;
                        foreach($enrollSubjects as $subject){
                            $enrollee = new Enrollment;
                            $enrollee->subject_id = $subject;
                            $enrollee->profile_id = $request->input('applicant_id');
                            $enrollee->course = $studentDetails->course;
                            $enrollee->year_level = $studentDetails->year_level;
                            $enrollee->status = 0;
                            $enrollee->save();
                            $enrolled[] = $enrollee->subject_id;

                            $unitType = Subject::where('id',$subject)->select('type','units')->first();
                            if($unitType->type == '0'){
                                $lecture_units = $lecture_units + $unitType->units;
                            } else {
                                $laboratory_units = $laboratory_units + $unitType->units;
                            }   
                        }

                        $enroll = Admission::where('profile_id', $request->input('applicant_id'))->first();
                        $fees = Option::where('type','fees')->get();
                    
                        foreach($fees as $fee){
                            if($fee->name == 'A. Lecture Tuition'){
                                $bill = new Billing;
                                $bill->admission_id = $enroll->id;
                                $bill->fee = $fee->name;
                                $bill->amount = $lecture_units * $fee->extra;
                                $bill->save();
                            } else if($fee->name == 'A. Laboratory Tuition'){
                                $bill = new Billing;
                                $bill->admission_id = $enroll->id;
                                $bill->fee = $fee->name;
                                $bill->amount = $laboratory_units * $fee->extra;
                                $bill->save();
                            } else {
                                $bill = new Billing;
                                $bill->admission_id = $enroll->id;
                                $bill->fee = $fee->name;
                                $bill->amount = $fee->extra;
                                $bill->save();
                            }
                        }
                    }
                }     
                $subjects = Subject::select('id','code','description')->get();
                $profile = Profile::where('id',$request->applicant_id)->select('school_id','first_name','last_name')->first();
                return response()->json([
                    'enrolled' => $enrolled,
                    'removed' => $removed,
                    'subjects' => $subjects,
                    'profile' => $profile
                ],200);
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
        $applicant = Profile::where('profiles.id',$id)
                            ->select('id','first_name','last_name','gender','civil_status','religion','course','year_level')
                            ->first();
        $subjects = Subject::all();
        
        $output = [
            $applicant,
            $subjects
        ];

        return response()->json($output);
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

    public function getEnrolledSubjects($id)
    {
        $enrolledSubjects = Enrollment::where('enrollments.profile_id',$id)
                                    ->join('subjects','enrollments.subject_id','subjects.id')
                                    ->join('schedules','subjects.schedule','schedules.id')
                                    ->join('profiles','subjects.instructor','profiles.id')
                                    ->select('enrollments.profile_id','enrollments.subject_id','subjects.code','subjects.description','subjects.schedule','subjects.instructor','subjects.units','schedules.location','schedules.type as locationType','schedules.day','schedules.time','profiles.first_name','profiles.last_name')
                                    ->get();
        if(is_null($enrolledSubjects)){
            return response()->json(
                'No Result'
            ,400);
        }
        return response()->json(
            $enrolledSubjects
        ,200);
    }
}
