<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admission;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\Schedule;

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
        $requests = Admission::where('status',4)->with('profile')
                                ->get();
        return DataTables::of($requests)
                ->addColumn('school_id', function($data){
                    $id = $data->profile->school_id;
                    return $id;
                })
                ->addColumn('last_name', function($data){
                    $lastName = $data->profile->last_name;
                    return $lastName;
                })
                ->addColumn('first_name', function($data){
                    $firstName = $data->profile->first_name;
                    return $firstName;
                })
                ->addColumn('course', function($data){
                    $courses = Course::all();
                    $studentCourse = '';
                    foreach($courses as $course){
                        if($course->id == $data->profile->course){
                            $studentCourse = $course->name;
                        }
                    }
                    return $studentCourse;
                })
                ->addColumn('year_level', function($data){
                    $yearLevels = ['Year','1st Year','2nd Year','3rd Year','4th Year'];
                    $year = $yearLevels[$data->profile->year_level];
                    return $year;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="/dashboard/cor/print/'.$data->profile->id.'" class="btn btn-warning btn-sm" target="_blank"><i class="fas fa-eye mr-1"></i> View COR</a>';                    
                    return $actionButtons;
                })
                ->rawColumns(['action','school_id','last_name','first_name','course','year_level'])
                ->make(true);
    }

    public function print($id)
    {
        $profile = Profile::where('id',$id)->with('enrollments')->first();
        $subjects = Subject::all();
        $instructors = Profile::where('role',4)->orWhere('role',5)->get();
        $schedules = Schedule::all();
        $totalUnits = 0;
        foreach($subjects as $subject){
            foreach($profile->enrollments as $enrollment){
                if($enrollment->subject_id == $subject->id){
                    $totalUnits = $totalUnits + $subject->units;
                }
            }
        }
        return view('admin.students.cor.print',compact('profile', 'subjects','instructors','schedules','totalUnits'));
    }
}