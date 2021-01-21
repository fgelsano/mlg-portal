<?php

namespace App\Http\Controllers\Dashboard\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use DateTime;

use App\Models\Admission;
use App\Models\Payment;
use App\Models\Course;
use App\Models\Profile;

class PaymentsController extends Controller
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
        return view('admin.payments.index');
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
        $student = Payment::where('payments.id',$id)
                        // ->where('ay',$this->globalAySem('ay'))
                        // ->where('sem',$this->globalAySem('sem'))
                        ->join('profiles','payments.profile_id','=','profiles.id')
                        ->select('profiles.school_id','profiles.first_name','profiles.last_name','profiles.middle_name','profiles.course','profiles.year_level','payments.*')
                        ->first();

        $courses = Course::all();

        $output = [
            'student' => $student,
            'courses' => $courses
        ];

        return $output;
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

            $validation = Validator::make($request->all(),[
                'payment_type' => 'required',
                'amount' => 'required',
                'or_number' => 'required',
            ]);
            // dd($request->all(), $id);
            $error_array = array();

            if($validation->fails()){
                foreach($validation->messages()->getMessages() as $field_name => $messages){
                    $error_array[] = $messages;
                }
                return response()->json([
                    'error' => $error_array,
                ],414);
            } else {
                $payment = Payment::where('id',$request->input('payment_id'))  
                                    ->where('ay',$this->globalAySem('ay'))
                                    ->where('sem',$this->globalAySem('sem'))
                                    ->first();

                $payment->type = $request->input('payment_type');
                $payment->amount = $request->input('amount');

                $balance = $request->input('previousBalance') - $request->input('amount');
                $payment->balance = $balance;

                $payment->or_number = $request->input('or_number');
                $payment->ref_number = $request->input('ref_number') ? $request->input('ref_number') : 'None';
                
                $now = new \DateTime('NOW');
                $date = $now->format('m-d-Y H:iA');
                $payment->others = $request->input('comments').' (Paid ₱'. $request->input('amount') .' on ' .$date. ') ';

                $payment->save();
    
                if(!$payment->save()){
                    return response()->json([
                        'error' => $payment,
                    ],414);
                }
    
                return response()->json([
                    'success' => 'Payment Accepted!',
                    'data' => $payment
                ],200);
            }
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
        $requests = Admission::where('academic_year',$this->globalAySem('ay'))
                                ->where('semester',$this->globalAySem('sem'))
                                ->where(function($query){
                                    return $query->where('status', 1)
                                        ->orWhere('status', 2)
                                        ->orWhere('status', 4);
                                })
                                ->join('profiles','profiles.id','=','admissions.profile_id')
                                ->join('courses','profiles.course','=','courses.id')
                                ->leftjoin('payments',function($join){
                                    $join->on('payments.profile_id','=','admissions.profile_id')
                                        ->on('payments.ay','=','admissions.academic_year')
                                        ->on('payments.sem','=','admissions.semester');
                                })
                                ->select('payments.id as paymentId','payments.balance','courses.code as course','profiles.last_name','profiles.first_name','profiles.school_id','profiles.year_level','admissions.status','admissions.created_at','admissions.profile_id','admissions.id as admissionId')
                                ->get();
        // dd($requests->all());
        return DataTables::of($requests)
                ->addColumn('balance', function($data){
                    if($data->balance == 0.00){
                        return '<span class="badge badge-pill badge-success">Paid Enrollment Fee</span>';
                    }
                    return $data->balance;
                })
                ->addColumn('status', function($data){
                    $status = '';

                    if($data->status == 0){
                        $status = '<span class="badge badge-pill badge-warning">Pending</span>';
                    } else if($data->status ==1){
                        $status = '<sapan class="badge badge-pill badge-primary">Cashier\'s Hold</span>';
                    } else if($data->status == 2){
                        $status = '<span class="badge badge-pill badge-success">Accepted</span>';
                    } else if($data->status == 3){
                        $status = '<span class="badge badge-pill badge-danger">Rejected</span>';
                    } else if($data->status == 4){
                        $status = '<span class="badge badge-pill badge-info">Enrolled</span>';
                    }

                    return $status;
                })
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
                    $display = '';
                    $print = '';
                    $bill = 'd-none invisible';
                    if($data->status == 4){
                        $bill = 'visible';
                    }
                    if($data->status != 1){
                        $display = 'd-none invisible';
                    }
                    if($data->status == 1){
                        $print = 'd-none';
                    }
                    $actionButtons = '<a href="" data-id="'.$data->paymentId.'" class="btn btn-sm makePayment btn-primary">
                                        <i class="fas fa-money-bill-alt"></i> Payment
                                      </a>
                                      <a href="" data-id="'.$data->paymentId.'" data-balance="'.$data->balance.'" class="btn btn-sm btn-success '.$display.'acceptAdmission '.$display.'">
                                        <i class="fas fa-user-check"></i> Accept
                                      </a>
                                      <a href="" data-admission-id="'.$data->id.'" class="btn btn-sm btn-info showBill '.$bill.'">
                                        <i class="fas fa-file-invoice-dollar"></i> Bill
                                      </a>
                                      <a href="" data-id="'.$data->paymentId.'" class="btn btn-sm btn-warning printPaymentConfirmation '.$print.'"><i class="fas fa-print"></i> Print</a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','status','balance','year_level'])
                ->make(true);
    }

    public function printConfirmation($id)
    {
        $payment = Payment::where('id',$id)->first();
        $profile = Profile::where('id',$payment->profile_id)->first();
        $courses = Course::all();        
        // dd($id,$payment,$profile,$courses);
        return view('admin.payments.payment-confirmation.print',compact('profile','courses','payment'));
    }

    public function bill($id)
    {
        
    }
}

        