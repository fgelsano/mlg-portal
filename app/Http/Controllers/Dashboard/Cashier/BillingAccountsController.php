<?php

namespace App\Http\Controllers\Dashboard\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Assessment;
use App\Models\Deduction;
use DataTables;
use Validator;

class BillingAccountsController extends Controller
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
        return view('admin.cashier-view.billing-accounts.index');
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
        // dd($request->all());
        $validation = Validator::make($request->all(),[
            'ay'                          => 'required',
            'sem'                         => 'required',
            'tuition-fee'                 => 'required',
            'miscellaneous-fee'           => 'required',
            'total-fees'                  => 'required',
            'deduction-description'       => 'required',
            'deduction-amount'            => 'required',
            'total-deductions'            => 'required',
        ]);

        if($validation->fails()){
            $errors = $validation->errors();
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray()
            ],414);
        } else {

            $assesssment = new Assessment;
            $assesssment->ay                = $request->input('ay');
            $assesssment->sem               = $request->input('sem');
            $assesssment->tuition_fee       = $request->input('tuition-fee');
            $assesssment->misc_fee          = $request->input('miscellaneous-fee');
            $assesssment->total             = $request->input('total-fees');
            $assesssment->balance_type      = $request->input('balance-type');
            $assesssment->student_id        = $request->input('student-id');
            $assesssment->save();

            foreach($request->input('deduction-description') as $key => $deduction){
                $deductions = new Deduction;
                $deductions->assessment_id      = $assesssment->id;
                $deductions->ay                 = $request->input('ay');
                $deductions->sem                = $request->input('sem');
                $deductions->deduction_name     = $request->input('deduction-description')[$key];
                $deductions->amount             = $request->input('deduction-amount')[$key];
                $deductions->save();
            }

            return response()->json([
                'success'       => 'Bill Added Successfully',
                'id'            => $request->input('student-id')
            ], 200);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('id',$id)->first();
        $assessments = Assessment::where('student_id',$id)->with('deductions')->get();
        $deductions = 0;
        foreach($assessments as $assessment){
            foreach($assessment->deductions as $deduction){
                $deductions += $deduction->amount;
            }
        }
        $totalDeductions = (float)$deductions;
        // dd($totalDeductions);
        return view('admin.cashier-view.billing-accounts.view-billing-account.view-account',compact('profile','assessments','totalDeductions'));
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
        $accounts = Profile::where('role','3')->select('id','last_name','first_name','course')->get();
        // dd($requests->all());
        return DataTables::of($accounts)
                ->addColumn('course',function($data){
                    $courseCode = '';
                    if($data->course == 1){
                        $courseCode = 'BSIT';
                    }elseif($data->course == 2){
                        $courseCode = 'BEED';
                    }elseif($data->course == 3){
                        $courseCode = 'BSED-Math';
                    }elseif($data->course == 4){
                        $courseCode = 'BSED-SS';
                    }else{
                        $courseCode = 'BSED+';
                    }
                    return $courseCode;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="/dashboard/billing-accounts/'.$data->id.'" class="btn btn-sm btn-primary" target="_blank"><i class="fas fa-eye mr-1"></i>View</a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','course'])
                ->make(true);
    }
}
