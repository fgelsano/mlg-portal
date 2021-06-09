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
        $ay = Option::where('type', 'current-ay')->first();
        $sem = Option::where('type', 'current-sem')->first();

        foreach ($request->input('grade') as $key => $grade) {
            // dd($request->all(), $key, $grade, $subId = (int)$request->input('subjectId'), $ay->id, $sem->id);
            if ($grade != null) {
                $checkExistingRecord = Grade::where('profileId', $key)->where('subjectId', $request->subjectId)->first();

                if (!$checkExistingRecord) {
                    Grade::create([
                        'subjectId' => (int)$request->input('subjectId'),
                        'profileId' => $key,
                        'grade' => strtoupper($grade),
                        'ay' => $ay->id,
                        'sem' => $sem->id,
                    ]);
                }
            }
        }
        foreach ($request->input('reexam') as $key => $reexam) {
            $checkExistingReExamRecord = Grade::where('profileId', $key)->where('subjectId', $request->subjectId)->first();
            // dd($checkExistingReExamRecord);
            if ($checkExistingReExamRecord->grade == 'INC') {
                $checkExistingReExamRecord->update([
                    'reexam' => $reexam,
                ]);
                // dd($reexam, $checkExistingReExamRecord, $request->reexam);
            }
            // dd($checkExistingReExamRecord);
        }

        return response()->json([
            $grade
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subjects = Subject::where('instructor', $id)->get();

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
        $subject = Subject::where('subjects.id', $id)
            ->join('schedules', 'subjects.schedule', '=', 'schedules.id')
            ->join('profiles', 'subjects.instructor', '=', 'profiles.id')
            ->select('subjects.id', 'code', 'description', 'units', 'subjects.type', 'location', 'day', 'time', 'subjects.ay', 'subjects.sem', 'profiles.first_name', 'profiles.last_name')
            ->first();

        $subjectAy = Option::where('id', $subject->ay)->select('name')->first();
        $subjectSem = Option::where('id', $subject->sem)->select('name')->first();
        $subjectAySem = [
            'ay' => $subjectAy->name,
            'sem' => $subjectSem->name
        ];
        $students = Subject::where('subjects.id', $id)
            ->join('enrollments', 'subjects.id', '=', 'subject_id')
            ->join('profiles', 'enrollments.profile_id', '=', 'profiles.id')
            // ->leftjoin('grades','profiles.id','=','grades.profileId')
            ->leftjoin('grades', function ($join) {
                $join->on('grades.subjectId', '=', 'subjects.id')
                    ->on('grades.profileId', '=', 'profiles.id');
            })
            ->select('code', 'description', 'school_id', 'first_name', 'last_name', 'profiles.id as profile_id', 'grade', 'reexam', 'grades.id as grade_id')
            ->get()->sortBy('last_name');
        // dd($students, $subject);
        // dd($students);
        return view('admin.instructor-view.grades.sections.grade', compact('subject', 'students', 'subjectAySem'));
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
        $grade = Grade::where('id', $request->gradeId)->first();
        if ($grade != null) {
            $grade->update([
                'grade' => $request->input('grade'),
            ]);
        }

        return response()->json([
            $grade
        ], 200);
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
