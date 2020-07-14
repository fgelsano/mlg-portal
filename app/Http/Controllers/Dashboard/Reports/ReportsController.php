<?php

namespace App\Http\Controllers\Dashboard\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Admission;
use App\Models\Profile;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = new \DateTime('NOW');
        $today = $now->format('m/d/Y');
        
        $totalStudents = Admission::where('status',4)->get();
        $yearLevel['1'] = 0;
        $yearLevel['2'] = 0;
        $yearLevel['3'] = 0;
        $yearLevel['4'] = 0;
        foreach($totalStudents as $student){
            $profile = Profile::where('id',$student->profile_id)->first();
            if($profile->year_level == 1){
                $yearLevel['1']++;
            } else if($profile->year_level == 2){
                $yearLevel['2']++;
            } else if($profile->year_level == 3){
                $yearLevel['3']++;
            } else if($profile->year_level == 4){
                $yearLevel['4']++;
            }
        }

        $totalIT = 0;
        $yearIT['1'] = 0;
        $yearIT['2'] = 0;
        $yearIT['3'] = 0;
        $yearIT['4'] = 0;
        foreach($totalStudents as $student){
            $profile = Profile::where('id',$student->profile_id)->first();
            if($profile->course == 1){
                $totalIT++;
                if($profile->year_level == 1){
                    $yearIT['1']++;
                } else if($profile->year_level == 2){
                    $yearIT['2']++;
                } else if($profile->year_level == 3){
                    $yearIT['3']++;
                } else if($profile->year_level == 4){
                    $yearIT['4']++;
                }
            }
        }
        $totalBEED = 0;
        $yearBEED['1'] = 0;
        $yearBEED['2'] = 0;
        $yearBEED['3'] = 0;
        $yearBEED['4'] = 0;
        foreach($totalStudents as $student){
            $profile = Profile::where('id',$student->profile_id)->first();
            if($profile->course == 2){
                $totalBEED++;
                if($profile->year_level == 1){
                    $yearBEED['1']++;
                } else if($profile->year_level == 2){
                    $yearBEED['2']++;
                } else if($profile->year_level == 3){
                    $yearBEED['3']++;
                } else if($profile->year_level == 4){
                    $yearBEED['4']++;
                }
            }
        }
        $totalBSEDMath = 0;
        $yearBSEDMath['1'] = 0;
        $yearBSEDMath['2'] = 0;
        $yearBSEDMath['3'] = 0;
        $yearBSEDMath['4'] = 0;
        foreach($totalStudents as $student){
            $profile = Profile::where('id',$student->profile_id)->first();
            if($profile->course == 3){
                $totalBSEDMath++;
                if($profile->year_level == 1){
                    $yearBSEDMath['1']++;
                } else if($profile->year_level == 2){
                    $yearBSEDMath['2']++;
                } else if($profile->year_level == 3){
                    $yearBSEDMath['3']++;
                } else if($profile->year_level == 4){
                    $yearBSEDMath['4']++;
                }
            }
        }
        $totalBSEDSocStu = 0;
        $yearBSEDSocStu['1'] = 0;
        $yearBSEDSocStu['2'] = 0;
        $yearBSEDSocStu['3'] = 0;
        $yearBSEDSocStu['4'] = 0;
        foreach($totalStudents as $student){
            $profile = Profile::where('id',$student->profile_id)->first();
            if($profile->course == 4){
                $totalBSEDSocStu++;
                if($profile->year_level == 1){
                    $yearBSEDSocStu['1']++;
                } else if($profile->year_level == 2){
                    $yearBSEDSocStu['2']++;
                } else if($profile->year_level == 3){
                    $yearBSEDSocStu['3']++;
                } else if($profile->year_level == 4){
                    $yearBSEDSocStu['4']++;
                }
            }
        }
        $totalBSEDSupplemental = 0;
        $yearBSEDSupplemental['1'] = 0;
        $yearBSEDSupplemental['2'] = 0;
        $yearBSEDSupplemental['3'] = 0;
        $yearBSEDSupplemental['4'] = 0;
        foreach($totalStudents as $student){
            $profile = Profile::where('id',$student->profile_id)->first();
            if($profile->course == 5){
                $totalBSEDSupplemental++;
                if($profile->year_level == 1){
                    $yearBSEDSupplemental['1']++;
                } else if($profile->year_level == 2){
                    $yearBSEDSupplemental['2']++;
                } else if($profile->year_level == 3){
                    $yearBSEDSupplemental['3']++;
                } else if($profile->year_level == 4){
                    $yearBSEDSupplemental['4']++;
                }
            }
        }
        return view('admin.reports.index',compact('today','totalStudents','yearLevel','totalIT','yearIT','totalBEED','yearBEED','totalBSEDMath','yearBSEDMath','totalBSEDSocStu','yearBSEDSocStu','totalBSEDSupplemental','yearBSEDSupplemental'));
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
}
