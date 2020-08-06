<?php

namespace App\Http\Controllers\Dashboard\Triggers;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Option;
use App\Models\Billing;
use App\Models\Enrollment;
use App\Models\Subject;
use Illuminate\Http\Request;

class TriggersController extends Controller
{
    public function billings()
    {
        $students = Admission::select('id','status','profile_id')->where('status','!=',0)->where('status','!=',3)->get();
        $fees = Option::where('type','fees')->get();

        $lecture_units = 0;
        $laboratory_units = 0;

        foreach($students as $student){
            $admissionId = Admission::where('profile_id',$student->profile_id)->select('id')->first();
            $enrollments = Enrollment::where('profile_id',$student->profile_id)->select('subject_id')->get();
            foreach($enrollments as $enrollment){
                $unitType = Subject::where('id',$enrollment->subject_id)->select('type','units')->first();

                if($unitType->type == '0'){
                    $lecture_units = $lecture_units + $unitType->units;
                } else {
                    $laboratory_units = $laboratory_units + $unitType->units;
                }  
            }    
            

            foreach($fees as $fee){
                if($fee->name == 'A. Lecture Tuition'){
                    $bill = new Billing;
                    $bill->admission_id = $admissionId->id;
                    $bill->fee = $fee->name;
                    $bill->amount = $lecture_units * $fee->extra;
                    $bill->save();
                } else if($fee->name == 'A. Laboratory Tuition'){
                    $bill = new Billing;
                    $bill->admission_id = $admissionId->id;
                    $bill->fee = $fee->name;
                    $bill->amount = $laboratory_units * $fee->extra;
                    $bill->save();
                } else {
                    $bill = new Billing;
                    $bill->admission_id = $admissionId->id;
                    $bill->fee = $fee->name;
                    if($student->year_level == 1){
                        if($fee->name == 'B. School Id' || $fee->name == 'D. NSTP (CWTS)'){
                            $bill->amount = $fee->extra;
                        } else {
                            $bill->amount = 0;
                        }
                    } else {
                        if($fee->name == 'B. School Id' || $fee->name == 'D. NSTP (CWTS)'){
                            $bill->amount = 0;
                        } else {
                            $bill->amount = $fee->extra;
                        }                        
                    }                    
                    $bill->save();
                }
            }
        }

        if($bill->save()){
            $status = 'success';
            $count = $students->count();
            return view('admin.triggers.billings.index', compact('status','count'));
        } else {
            $status = $bill->save();
            return view('admin.triggers.billings.index', compact('status'));
        }
    }

    public function enrollments()
    {

    }
}
