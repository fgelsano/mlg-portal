<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Admission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use App\Models\Admission;

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
        if(request()->ajax()){
            $admission = Admission::where('id', $id)->first();
            return response()->json($admission);
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
            
            $admission = Admission::where('id',$id)->first();

            if($request->requestType == 'markAceept'){
                $admission->status = '1';
            } else {
                $admission->status = $request->buttonAction == 'Reject' ? '2' : '1';
                $admission->comments = $request->rejectReason;
            }
            
            $admission->save();
    
            $output = array(
                'success' => 'Admission Rejected!',
                'data' => $admission
            );
    
            return response()->json($output);
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
        $requests = Admission::where('status','0')
                                ->orWhere('status','1')
                                ->orWhere('status','2')
                                ->get();
        return DataTables::of($requests)
                ->addColumn('status', function($data){
                    $status = '';

                    if($data->status === 0){
                        $status = '<span class="badge badge-pill badge-warning">Pending</span>';
                    } else if($data->status === 1){
                        $status = '<span class="badge badge-pill badge-success">Accepted</span>';
                    } else {
                        $status = '<span class="badge badge-pill badge-danger">Rejected</span>';
                    }

                    return $status;
                })
                ->addColumn('action', function($data){
                    if($data->status === 0){
                        $color = 'warning';
                    } else if ($data->status === 1){
                        $color = 'success';
                    } else if($data->status === 2) {
                        $color = 'danger';
                    }

                    if($data->status == 2){
                        $status = 'd-none';
                    } else {
                        $status = '';
                    }

                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-'.$color.' evalAdmission" data-toggle="modal" data-target="#admission-modal">
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
