<?php

namespace App\Http\Controllers\Dashboard\Instructors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Validator;

use App\Models\Profile;

class InstructorsController extends Controller
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
        return view('admin.instructors.index');
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
            'last-name'     => 'required',
            'first-name'     => 'required',
            'middle-name'   => 'required',
            'status'        => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            // create instructor
            $instructor = new Profile;
            $instructor->last_name = $request->input('last-name');
            $instructor->first_name = $request->input('first-name');
            $instructor->middle_name = $request->input('middle-name');
            $instructor->status = $request->input('status');
            $instructor->type = '1';
            $instructor->save();

            $success_output = '<p class="m-0">Instructor Added!</p>';
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
            $instructor = Profile::where('id', $id)->first();
            return response()->json($instructor);
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
            'last-name'     => 'required',
            'first-name'     => 'required',
            'middle-name'   => 'required',
            'status'        => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            // create instructor
            $instructor = Profile::where('id', $id)->first();
            $instructor->last_name = $request->input('last-name');
            $instructor->first_name = $request->input('first-name');
            $instructor->middle_name = $request->input('middle-name');
            $instructor->status = $request->input('status');
            $instructor->type = '1';
            $instructor->save();

            $success_output = '<p class="m-0">Instructor Updated!</p>';
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
        return DataTables::of(Profile::latest()->get())
                ->addColumn('status', function($data){
                    $status = '';

                    if($data->status === 3){
                        $status = '<span class="badge badge-pill badge-primary">Full-time</span>';
                    } else if($data->status === 4){
                        $status = '<span class="badge badge-pill badge-warning">Part-time</span>';
                    }

                    return $status;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-warning editInstructor">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteInstructor">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }

    public function instructorList()
    {
        if(request()->ajax()){
            $instructors = Profile::select('id','first_name','last_name')->where('type', '1')->get();
        }

        return response()->json($instructors);
    }
}
