<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Models\Admission;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\Option;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->password_changed == 0){
            $user = User::where('users.id',Auth::user()->id)
                            ->join('profiles','users.profile_id','=','profiles.id')
                            ->select('profiles.id as profile_id','profiles.first_name','users.*')
                            ->first();
            return view('auth.passwords.reset')->with('user', $user);
        }
        return view('admin/dashboard');
    }

    public function dashboardCheck()
    {        
        $requests = Admission::where('academic_year',$this->globalAySem('ay'))
                                ->where('semester',$this->globalAySem('sem'))->get();
        
        $enrolled = Admission::where('status',4)->where('academic_year',$this->globalAySem('ay'))->where('semester',$this->globalAySem('sem'))->get();
        $instructors = Profile::where('role',4)->orWhere('role',5)->get();
        $students = User::where('role',3)->get();
        $subjects = Subject::where('ay',$this->globalAySem('ay'))->where('sem',$this->globalAySem('sem'))->get();

        return response()->json([
            'requests' => $requests->count(),
            'enrolled' => $enrolled->count(),
            'instructors' => $instructors->count(),
            'students' => $students->count(),
            'subjects' => $subjects->count()
        ], 200);
    }

    public function notifications()
    {
        // New Admissions
        $newAdmissions = Admission::where('status',0)
                                    ->where('academic_year',$this->globalAySem('ay'))
                                    ->where('semester',$this->globalAySem('sem'))
                                    ->join('profiles','admissions.profile_id','=','profiles.id')
                                    ->select('last_name','first_name','profile_id','admissions.created_at')
                                    ->get();
            
        // New For Enrollments
        $forEnrollments = Admission::where('status',2)
                                    ->where('academic_year',$this->globalAySem('ay'))
                                    ->where('semester',$this->globalAySem('sem'))
                                    ->join('profiles','admissions.profile_id','=','profiles.id')
                                    ->select('last_name','first_name','profile_id','admissions.updated_at')
                                    ->get();

        // Rejected Requests
        $rejectedRequests = Admission::where('status',3)
                                    ->where('academic_year',$this->globalAySem('ay'))
                                    ->where('semester',$this->globalAySem('sem'))
                                    ->join('profiles','admissions.profile_id','=','profiles.id')
                                    ->select('last_name','first_name','profile_id','comment','admissions.updated_at')
                                    ->get();

        return response()->json([
            'newAdmissions' => $newAdmissions,
            'forEnrollments' => $forEnrollments,
            'rejectedRequests' => $rejectedRequests
        ], 200);
    }
}
