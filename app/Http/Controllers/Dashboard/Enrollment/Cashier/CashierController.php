<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admission;
use DataTables;

class CashierController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return $this->generateDatatables();
        };
        return view('admin.enrollment.cashier.index');
    }

    public function generateDatatables()
    {
        $requests = Admission::where('status',1)
                                ->join('profiles','profiles.id','=','admissions.profile_id')
                                ->select('profiles.last_name','profiles.first_name','profiles.school_graduated','admissions.status','admissions.id','admissions.created_at','admissions.profile_id')
                                ->get();
        // dd($requests);
        return DataTables::of($requests)
                ->addColumn('status', function($data){
                    $status = '<span class="badge badge-pill badge-primary">Cashier\'s Hold</span>';
                    return $status;
                })
                ->rawColumns(['status'])
                ->make(true);
    }
}
