<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Admission;
use App\Models\Profile;
use App\Models\Course;
use App\Models\Option;

class RejectedRequestsController extends Controller
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
        return view('admin.enrollment.rejected.index');
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
        $requests = Admission::where('status',3)
                    ->where('academic_year',$this->globalAySem('ay'))
                    ->where('semester',$this->globalAySem('sem'))
                    ->join('profiles','profiles.id','=','admissions.profile_id')
                    ->select('profiles.year_level','profiles.last_name','profiles.first_name','admissions.status','admissions.id','admissions.created_at','admissions.profile_id','admissions.comment')
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
                ->addColumn('status', function($data){
                    $status = '';

                    if($data->status === 0){
                        $status = '<span class="badge badge-pill badge-warning">Pending</span>';
                    } else if($data->status === 1){
                        $status = '<span class="badge badge-pill badge-primary">Cashier\'s Hold</span>';
                    } else if($data->status === 2){
                        $status = '<span class="badge badge-pill badge-success">Accepted</span>';
                    } else if($data->status === 3){
                        $status = '<span class="badge badge-pill badge-danger">Rejected</span>';
                    } else if($data->status === 4){
                        $status = '<span class="badge badge-pill badge-info">Enrolled</span>';
                    }

                    return $status;
                })
                ->addColumn('action', function($data){
                    $color = '';
                    if($data->status === 0 || $data->status === 1){
                        $color = 'warning';
                    } else if ($data->status === 2){
                        $color = 'success';
                    } else if($data->status === 3) {
                        $color = 'danger';
                    } else if($data->status === 4){
                        $color = 'info';
                    }

                    if($data->status === 2 || $data->status == 3 || $data->status == 4){
                        $status = 'd-none';
                    } else {
                        $status = '';
                    }

                    $evaluateBtn = '<a href="" data-id="'.$data->profile_id.'" class="btn btn-sm btn-'.$color.' evalAdmission"><i class="fas fa-eye"></i> Evaluate</a>';
                    $enrollBtn = '<a href="" data-id="'.$data->profile_id.'" class="btn btn-sm btn-'.$color.' enrollStudent" data-toggle="modal" data-target="#enroll-modal"><i class="fas fa-folder-open"></i> Enroll</a>';
                    $editEnrollBtn = '<a href="" data-id="'.$data->profile_id.'" class="btn btn-sm btn-'.$color.' editEnrollment" data-toggle="modal" data-target="#enroll-modal"><i class="fas fa-edit"></i> Edit</a>';
                    
                    if($data->status == 2){
                        $actionBtn = $enrollBtn;
                    } else if($data->status == 1){
                        $actionBtn = '';
                        $status = 'd-none';
                    } else if($data->status == 4){
                        $actionBtn = $editEnrollBtn;
                    } else {
                        $actionBtn = $evaluateBtn;
                    }

                    $actionButtons = $actionBtn.
                                      '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-'.$color.' deleteAdmission '.$status.'">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }
}
