<?php

namespace App\Http\Controllers\Dashboard\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Billing;
use App\Models\Admission;

class CashierBillingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request->input('amount'));
        $saved = FALSE;
        foreach($request->input('amount') as $key => $amount){
            $bill = Billing::where('id',$key)->first();
            $bill->amount = $amount;
            $bill->save();

            if($bill->save()){
                $saved = TRUE;
            } else {
                $saved = FALSE;
            }
        }
        if($saved == TRUE){
            return response()->json(
                'Success'
            ,200);
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
        $profile = Admission::where('admissions.id',$id)
                    ->join('profiles','admissions.profile_id','=','profiles.id')
                    ->join('courses','profiles.course','=','courses.id')
                    ->select('profiles.school_id','profiles.first_name','profiles.last_name','profiles.year_level','courses.code')
                    ->first();
        $bill = Billing::where('admission_id',$id)->get();
        // dd($id, $bill->count(), $bill);
        return response()->json([
            'bill' => $bill,
            'profile' => $profile
        ],200);
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
