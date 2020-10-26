<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Profile;

class StudentClearancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.student-view.clearances.index');
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
        $clearances = Enrollment::where('profile_id',$id)
                                ->join('subjects','enrollments.subject_id','=','subjects.id')
                                ->join('profiles','profiles.id','=','subjects.instructor')
                                ->leftjoin('clearances',function($join){
                                    $join->on('clearances.subjectId','=','subjects.id')
                                         ->on('clearances.studentId','=','enrollments.profile_id');
                                })
                                ->select('subjects.id','subjects.code','subjects.description','subjects.type','profiles.last_name','profiles.first_name','clearances.id as clearanceId')
                                ->get();

        return view('admin.student-view.clearances.index',compact('clearances'));
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
