<?php

namespace App\Http\Controllers\Dashboard\Instructors;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Option;

use App\Models\Subject;

class InstructorGradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $subjects = Subject::where('instructor',$id)->get();
        
        return view('admin.instructor-view.grades.index', compact('subjects'));
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
        // dd($request->all());
        $ay = Option::where('type','current-ay')->first();
        $sem = Option::where('type','current-sem')->first();
        
        foreach($request->input('grade') as $key => $grade){
            // dd($request->all(), $key, $grade, $subId = (int)$request->input('subjectId'), $ay->id, $sem->id);
            if($grade != null){
                $checkExistingRecord = Grade::where('profileId', $key)->where('subjectId',$request->subjectId)->first();

                if(!$checkExistingRecord){
                    Grade::create([
                        'subjectId' => (int)$request->input('subjectId'),
                        'profileId' => $key,
                        'grade' => $grade,
                        'ay' => $ay->id,
                        'sem' => $sem->id,
                    ]);
                }           
            }
        }
        
        return response()->json([
            $grade
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subjects = Subject::where('instructor',$id)->get();
        
        return view('admin.instructor-view.grades.index', compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::where('subjects.id',$id)
                            ->join('schedules','subjects.schedule','=','schedules.id')
                            ->leftjoin('options','schedules.ay','=','options.id')
                            ->select('subjects.id','code','description','units','subjects.type','options.name as ay','sem','location','day','time')
                            ->first();
        $students = Subject::where('subjects.id',$id)
                            ->join('enrollments','subjects.id','=','subject_id')
                            ->join('profiles','enrollments.profile_id','=','profiles.id')
                            // ->leftjoin('grades','profiles.id','=','grades.profileId')
                            ->leftjoin('grades',function($join){
                                $join->on('grades.subjectId','=','subjects.id')
                                     ->on('grades.profileId','=','profiles.id');
                            })
                            ->select('code','description','school_id','first_name','last_name','profiles.id as profile_id','grade','grades.id as grade_id')
                            ->get()->sortBy('last_name');
        // dd($students, $subject);
        return view('admin.instructor-view.grades.sections.grade', compact('subject','students'));
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
        $grade = Grade::where('id',$request->gradeId)->first();
        if($grade != null){
            $grade->update([
                'grade' => $request->input('grade'),
            ]);
        }
        
        return response()->json([
            $grade
        ],200);
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
