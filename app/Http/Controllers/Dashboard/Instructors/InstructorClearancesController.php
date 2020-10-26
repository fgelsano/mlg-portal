<?php

namespace App\Http\Controllers\Dashboard\Instructors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Profile;

class InstructorClearancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.instructor-view.clearances.index');
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
        $subjects = Subject::where('instructor',$id)->get();
        $schedules = Schedule::all();
        $totalUnits = 0;
        foreach($subjects as $subject){
            $totalUnits = $totalUnits + $subject->units;
        }
        return view('admin.instructor-view.clearances.index',compact('subjects','schedules','totalUnits'));
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

    public function print($id)
    {
        $profile = Profile::where('id',$id)->first();
        $subjects = Subject::where('instructor',$id)->get();
        $schedules = Schedule::all();
        // dd($subjects);
        $totalUnits = 0;
        foreach($subjects as $subject){
            $totalUnits = $totalUnits + $subject->units;
        }
        return view('admin.instructor-view.print.clearances-loads',compact('profile', 'subjects','schedules','totalUnits'));
    }
}
