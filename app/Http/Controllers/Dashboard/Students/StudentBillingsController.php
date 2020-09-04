<?php

namespace App\Http\Controllers\Dashboard\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Enrollment;
use App\Models\Profile;
use App\Models\Billing;
use App\Models\Payment;


class StudentBillingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.student-view.billings.index');
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
        $profile = Profile::where('profiles.id',$id)
                    ->join('courses','profiles.course','=','courses.id')
                    ->join('admissions','profiles.id','=','admissions.profile_id')
                    ->select('profiles.profile_pic','profiles.first_name','profiles.middle_name','profiles.last_name','profiles.contact_number','profiles.school_id','profiles.year_level','profiles.purok','profiles.sitio','profiles.barangay','profiles.municipality','profiles.province','profiles.zipcode','courses.name as course','admissions.id as admission_id')
                    ->first();
        $bills = Billing::where('admission_id',$profile->admission_id)->get();
        
        $totalBill = 0;
        foreach($bills as $bill){
            $totalBill = $totalBill + $bill->amount;
        }
        number_format($totalBill);
        $payment = Payment::where('profile_id',$id)->select('amount','others')->first();
        number_format($payment->amount);
        return view('admin.student-view.billings.index',compact('profile','bills','totalBill','payment'));
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
