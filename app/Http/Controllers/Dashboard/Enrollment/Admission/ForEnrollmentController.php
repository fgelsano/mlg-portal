<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Admission;
use App\Models\Profile;
use App\Models\Course;
use App\Models\Option;

class ForEnrollmentController extends Controller
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
        return view('admin.enrollment.for-enrollment.index');
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
        $requests = Admission::where('status',2)
                    ->where('academic_year',$this->globalAySem('ay'))
                    ->where('semester',$this->globalAySem('sem'))
                    ->join('profiles','admissions.profile_id','=','profiles.id')
                    ->join('courses','profiles.course','=','courses.id')
                    ->select('profiles.year_level','profiles.last_name','profiles.first_name','admissions.id','admissions.created_at','admissions.profile_id','courses.code as course')
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
                ->addColumn('action', function($data){
                    $enrollBtn = '<a href="" data-id="'.$data->profile_id.'" class="btn btn-sm btn-success enrollStudent"><i class="fas fa-folder-open"></i> Enroll</a>';

                    // $actionButtons = $enrollBtn.
                    //                   '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteAdmission">
                    //                     <i class="fas fa-trash"></i>
                    //                   </a>';
                    return $enrollBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
