<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Profile;
use App\Models\Schedule;
use App\Models\Subject;

class StudentGradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.student-view.grades.index');
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
        $gradesBySubject = [];
        $ay = Option::where('type','current-ay')->first();
        $sem = Option::where('type','current-sem')->first();
        $enrollment = Enrollment::where('profile_id',$id)
                                ->where('academic_year',$ay->id)
                                ->where('semester',$sem->id)->get();   
                                
        foreach($enrollment as $enroll){
            $subject = Subject::where('id',$enroll->subject_id)->first();
            $profile = Profile::where('id',$subject->instructor)->first();
            $schedule = Schedule::where('id',$subject->schedule)->first();
            $grade = Grade::where('subjectId',$subject->id)->where('profileId',$enroll->profile_id)->first();
            
            $info = [
                'id' => $subject->id,
                'code' => $subject->code,
                'description' => $subject->description,
                'instructor_firstName' => $profile->first_name,
                'instructor_lastName' => $profile->last_name,
                'day' => $schedule->day,
                'time' => $schedule->time,
                'classroomType' => $schedule->type,
                'location' => $schedule->location,
                'grade' => empty($grade) && empty($grade->grade) ? 'No Grade' : $grade->grade 
            ];

            array_push($gradesBySubject,$info);
        }

        $profile = Profile::where('profiles.id',$id)
                            ->join('courses','profiles.course','=','courses.id')
                            ->select('profiles.profile_pic','profiles.first_name','profiles.last_name','profiles.contact_number','profiles.gender','profiles.civil_status','profiles.religion','profiles.purok','profiles.sitio','profiles.barangay','profiles.municipality','profiles.province','profiles.zipcode','profiles.school_id','profiles.emergency_contact_name','profiles.emergency_contact_number','profiles.lrn','profiles.school_graduated','profiles.year_graduated','profiles.school_address','profiles.year_level','courses.code','courses.name')
                            ->first();
        $displayGrade = Option::where('type','display-grade')->first();
        
        return view('admin.student-view.grades.index',compact('gradesBySubject','profile','displayGrade'));
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
