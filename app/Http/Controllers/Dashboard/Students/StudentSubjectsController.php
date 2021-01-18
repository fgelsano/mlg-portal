<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\UserEmail;
use App\User;

class StudentSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $profile = Profile::where('id',$id)->with('enrollments')->first();
        
        $subjects = Subject::where('subjects.ay',$this->globalAySem('ay'))
                            ->where('subjects.sem',$this->globalAySem('sem'))
                            ->join('profiles','subjects.instructor','=','profiles.id')
                            ->join('schedules','subjects.schedule','=','schedules.id')
                            ->select('profiles.id','profiles.last_name','profiles.first_name','subjects.id as subjectId','subjects.code','subjects.description','subjects.units','subjects.type as subjectType','schedules.day','schedules.time','schedules.location','schedules.type as roomType')
                            ->get();
        $user = User::where('profile_id',$id)->select('id')->first();
        $credentials = UserEmail::where('user_id',$user->id)->first();
        
        // dd($profile->enrollments,$subjects);
        return view('admin.student-view.subjects.index',compact('profile', 'subjects','credentials'));
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
