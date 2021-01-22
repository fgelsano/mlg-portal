<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admission;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\Schedule;
use App\User;
use DataTables;

class StudentsController extends Controller
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
        return view('admin.students.index');
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
        $requests = Profile::where('profiles.role',3)
                            // ->join('courses','profiles.course','=','courses.id')
                            // ->select('school_id','last_name','first_name','course','year_level')
                            ->get();
        // dd($requests);
        return DataTables::of($requests)
                ->addColumn('school_id', function($data){
                    $id = $data->school_id;
                    return $id;
                })
                ->addColumn('last_name', function($data){
                    $lastName = $data->last_name;
                    return $lastName;
                })
                ->addColumn('first_name', function($data){
                    $firstName = $data->first_name;
                    return $firstName;
                })
                ->addColumn('course', function($data){
                    $courses = Course::all();
                    $studentCourse = '';
                    foreach($courses as $course){
                        if($course->id == $data->course){
                            $studentCourse = $course->name;
                        }
                    }
                    return $studentCourse;
                })
                ->addColumn('year_level', function($data){
                    $yearLevels = ['Year','1st Year','2nd Year','3rd Year','4th Year'];
                    $year = $yearLevels[$data->year_level];
                    return $year;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<button class="btn btn-primary btn-sm viewProfile" target="_blank" title="View Profile" data-id="'.$data->id.'" data-toggle="modal" data-target="#profile-modal"><i class="fas fa-eye"></i></button>
                                        <a href="/dashboard/cor/print/'.$data->id.'" class="btn btn-warning btn-sm viewCOR" target="_blank" title="View COR"><i class="fas fa-scroll"></i></a>
                                        <a href="/dashboard/student/grades/'.$data->id.'" class="btn btn-success btn-sm ml-1" target="_blank" title="View Grades" data-id="'.$data->id.'"><i class="fas fa-percentage"></i></a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','school_id','last_name','first_name','course','year_level'])
                ->make(true);
    }

    public function print($id)
    {
        // $profile = Profile::where('id',$id)->with('enrollments')->first();
        // $subjects = Subject::all();
        // $instructors = Profile::where('role',4)->orWhere('role',5)->get();
        // $schedules = Schedule::all();
        // $totalUnits = 0;
        // foreach($subjects as $subject){
        //     foreach($profile->enrollments as $enrollment){
        //         if($enrollment->subject_id == $subject->id){
        //             $totalUnits = $totalUnits + $subject->units;
        //         }
        //     }
        // }

        $profile = Profile::where('id',$id)->first();
        
        $subjects = Subject::where('subjects.ay',$this->globalAySem('ay'))
                            ->where('subjects.sem',$this->globalAySem('sem'))
                            ->join('profiles','subjects.instructor','=','profiles.id')
                            ->join('schedules','subjects.schedule','=','schedules.id')
                            ->select('profiles.id','profiles.last_name','profiles.first_name','subjects.id as subjectId','subjects.code','subjects.description','subjects.units','subjects.type as subjectType','schedules.day','schedules.time','schedules.location','schedules.type as roomType')
                            ->get();
        
        // dd($user,$credentials);
        // return view('admin.student-view.subjects.index',compact('profile', 'subjects','credentials'));
        return view('admin.students.cor.print',compact('profile', 'subjects'));
    }
}