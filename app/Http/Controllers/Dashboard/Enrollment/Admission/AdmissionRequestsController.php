<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Admission;
use App\Models\Profile;

class AdmissionRequestsController extends Controller
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
        return view('admin.enrollment.requests');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        if(request()->ajax()){
            // $admission = Admission::where('id', $id)
            //                 ->join('profiles','profiles.id','=','admissions.profile_id')
            //                 ->first();
            $profile = Profile::where('profiles.id',$id)
                                ->join('admissions','profiles.id','=','admissions.profile_id')
                                ->select('profiles.*','admissions.status','admissions.comment')
                                ->with('documents')
                                ->first();
            return response()->json($profile);
        }
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
        if(request()->ajax()){
            
            $admission = Admission::where('profile_id',$id)->first();

            if($request->requestType == 'markAccept'){
                $admission->status = '1';
            } else {
                $admission->status = $request->buttonAction == 'Reject' ? '3' : '1';
                $admission->comment = $request->rejectReason;
            }
            
            $admission->save();
    
            if(!$admission->save()){
                return response()->json([
                    'Error' => 'Update failed',
                ],414);
            }
    
            return response()->json([
                'success' => 'Admission Rejected!',
                'data' => $admission
            ],200);
        };
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
        $requests = Admission::where('status',0)
                                ->orWhere('status',2)
                                ->orWhere('status',3)
                                ->join('profiles','profiles.id','=','admissions.profile_id')
                                ->select('profiles.last_name','profiles.first_name','profiles.school_graduated','admissions.status','admissions.id','admissions.created_at','admissions.profile_id')
                                ->get();
        // dd($requests);
        return DataTables::of($requests)
                ->addColumn('status', function($data){
                    $status = '';

                    if($data->status === 0){
                        $status = '<span class="badge badge-pill badge-warning">Pending</span>';
                    } else if($data->status === 2){
                        $status = '<span class="badge badge-pill badge-success">Accepted</span>';
                    } else if($data->status === 3){
                        $status = '<span class="badge badge-pill badge-danger">Rejected</span>';
                    }

                    return $status;
                })
                ->addColumn('action', function($data){
                    if($data->status === 0){
                        $color = 'warning';
                    } else if ($data->status === 2){
                        $color = 'success';
                    } else if($data->status === 3) {
                        $color = 'danger';
                    }

                    if($data->status == 3){
                        $status = 'd-none';
                    } else {
                        $status = '';
                    }

                    $actionButtons = '<a href="" data-id="'.$data->profile_id.'" class="btn btn-sm btn-'.$color.' evalAdmission" data-toggle="modal" data-target="#admission-modal">
                                        <i class="fas fa-eye"></i> Evaluate
                                      </a>
                                      <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-'.$color.' deleteAdmission '.$status.'">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }
}
