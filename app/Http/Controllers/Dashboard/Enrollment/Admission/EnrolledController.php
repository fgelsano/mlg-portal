<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Admission;
use App\Models\Profile;
use App\Models\Course;

class EnrolledController extends Controller
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
        return view('admin.enrollment.enrolled.index');
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
        $requests = Admission::where('status',4)
                    ->join('profiles','profiles.id','=','admissions.profile_id')
                    ->select('profiles.year_level','profiles.last_name','profiles.first_name','profiles.course','admissions.id','admissions.created_at','admissions.profile_id','admissions.updated_at')
                    ->get();
        return DataTables::of($requests)
                ->addColumn('year_level', function($data){
                    $year = '';
                    if($data->year_level == 1){
                        $year = '1st Year';
                    } else if($data->year_level == 2){
                        $year = '2nd Year';
                    } else if($data->year_level == 3){
                        $year = '3rd Year';
                    } else if($data->year_level == 4){
                        $year = '4th Year';
                    }
                    return $year;
                })
                ->addColumn('course', function($data){
                    $course = '';
                    if($data->course == 1){
                        $course = 'BSIT';
                    } else if($data->course == 2){
                        $course = 'BEED';
                    } else if($data->course == 3){
                        $course = 'BSED-Math';
                    } else if($data->course == 4){
                        $course = 'BSED-SocStu';
                    } else if($data->course == 5){
                        $course = 'BSED-Supplemental';
                    }
                    return $course;
                })
                ->addColumn('date', function($data){
                    $date = date('m-d-Y', strtotime($data->updated_at));
                    return $date;
                })
                ->addColumn('action', function($data){
                    $enrollBtn = '<a href="" data-id="'.$data->profile_id.'" class="btn btn-sm btn-success viewStudent" data-toggle="modal" data-target="#enroll-modal"><i class="fas fa-eye"></i> View</a>';

                    return $enrollBtn;
                })
                ->rawColumns(['action','course','year_level','date'])
                ->make(true);
    }
}
