<?php

namespace App\Http\Controllers\Dashboard\Enrollment\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DataTables;

use App\Models\Option;
use App\Models\Profile;
use App\Models\Schedule;

use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
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
        return view('admin.enrollment.settings.options');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'type' => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            // create option
            $option = new Option;
            $option->name = $request->input('name');
            $option->type = $request->input('type');
            $option->extra = $request->input('extra');
            $option->save();

            $success_output = '<p class="m-0">Option Added!</p>';
        }

        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );

        return response()->json($output);
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
        if(request()->ajax()){
            $option = Option::where('id', $id)->first();
            return response()->json($option);
        }
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
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'type' => 'required',
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            // create option
            $option = Option::where('id', $id)->first();
            $option->name = $request->input('name');
            $option->type = $request->input('type');
            $option->extra = $request->input('extra');
            $option->save();

            $success_output = '<p class="m-0">Option Updated!</p>';
        }

        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );

        return response()->json($output);
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
        return DataTables::of(Option::latest()->get())
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-warning editOption">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteOption">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function lists()
    {
        if(request()->ajax()){
            $subjectCategories = Option::where('type', 'subject-category')->get();
            $instructors = Profile::select('id','first_name','last_name')->where('type', '1')->get();
            $roomsLabs = Option::where('type','room')->orWhere('type','lab')->get();
            $sy = Option::where('type','sy')->get();
            $schedules = Schedule::get();
        }
        
        $output = [
            'categories' => $subjectCategories,
            'instructors' => $instructors,
            'roomslabs' => $roomsLabs,
            'schedules' => $schedules,
            'sy' => $sy,
        ];
        
        return response()->json($output);
    }
}
