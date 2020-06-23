<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\User;

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

    public function initialReset($id)
    {

    }
}
