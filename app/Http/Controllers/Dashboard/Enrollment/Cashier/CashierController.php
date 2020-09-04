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
                                ->select('profiles.last_name','profiles.first_name','profiles.school_graduated','profiles.year_level','admissions.id','admissions.created_at','admissions.profile_id')
                                ->get();
        // dd($requests);
        return DataTables::of($requests)
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
                    $action = '<a href="#" class="btn btn-sm btn-primary viewStudent" data-id="'.$data->profile_id.'"><i class="fas fa-eye"></i> View</a>';
                    return $action;
                })
                ->rawColumns(['action','year_level'])
                ->make(true);
    }
}
