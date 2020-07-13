<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Models\Admission;
use App\Models\Profile;
use App\Models\Subject;

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
                        // dd($user);
            return view('auth.passwords.reset')->with('user', $user);
        }
        return view('admin/dashboard');
    }

    public function dashboardCheck()
    {
        $requests = Admission::all();
        $enrolled = Admission::where('status',4)->get();
        $instructors = Profile::where('role',4)->orWhere('role',5)->get();
        $students = User::where('role',3)->get();
        $subjects = Subject::all();

        return response()->json([
            'requests' => $requests,
            'enrolled' => $enrolled,
            'instructors' => $instructors,
            'students' => $students,
            'subjects' => $subjects
        ], 200);
    }

    public function notifications()
    {
        // New Admissions
        $newAdmissions = Admission::where('status',0)
                        ->join('profiles','admissions.profile_id','=','profiles.id')
                        ->select('last_name','first_name','profile_id','admissions.created_at')
                        ->get();
            
        // New For Enrollments
        $forEnrollments = Admission::where('status',2)
                        ->join('profiles','admissions.profile_id','=','profiles.id')
                        ->select('last_name','first_name','profile_id','admissions.updated_at')
                        ->get();

        // Rejected Requests
        $rejectedRequests = Admission::where('status',3)
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
