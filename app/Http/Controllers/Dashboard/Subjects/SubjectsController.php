<?php

namespace App\Http\Controllers\Dashboard\Subjects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use Validator;

use App\Models\Subject;
use App\Models\Option;
use App\Models\Profile;
use App\Models\Schedule;

use Illuminate\Support\Facades\DB;

class SubjectsController extends Controller
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
        return view('admin.subjects.index');
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
        $validation = Validator::make($request->all(),[
            'code'          => 'required',
            'description'   => 'required',
            'category'      => 'required',
            'instructor'    => 'required',
            'room-lab'      => 'required',
            'schedule'      => 'required',
            'sy'            => 'required',
            'sem'           => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            // create instructor
            $subject = new Subject;
            $subject->code = $request->input('code');
            $subject->description = $request->input('description');
            $subject->category = $request->input('category');
            $subject->instructor = $request->input('instructor');
            $subject->location = $request->input('room-lab');
            $subject->schedule = $request->input('schedule');
            $subject->sy = $request->input('sy');
            $subject->sem = $request->input('sem');
            $subject->save();

            $success_output = '<p class="m-0">Subject Added!</p>';
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
        if(request()->ajax()){
            $subject = Subject::where('id', $id)->first();
            return response()->json($subject);
        }
    }

    public function pickedSubjects($id)
    {
        if(request()->ajax()){
            $subject = DB::table('subjects')
                        ->join('profiles','profiles.id', '=', 'subjects.instructor')
                        ->join('options', 'options.id', '=', 'subjects.location')
                        ->join('schedules','schedules.id', '=', 'subjects.schedule')
                        ->where('subjects.id','=', $id)
                        ->select('subjects.id','profiles.first_name','profiles.last_name','options.name as location','subjects.code','subjects.description','schedules.schedule')
                        ->get();
            return response()->json($subject);
        }
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
            $subject = Subject::where('id', $id)->first();
            return response()->json($subject);
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
            'code'          => 'required',
            'description'   => 'required',
            'category'      => 'required',
            'instructor'    => 'required',
            'room-lab'      => 'required',
            'schedule'      => 'required',
            'sy'            => 'required',
            'sem'           => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        } else {
            
            // create instructor
            $subject = Subject::where('id', $id)->first();
            $subject->code = $request->input('code');
            $subject->description = $request->input('description');
            $subject->category = $request->input('category');
            $subject->instructor = $request->input('instructor');
            $subject->location = $request->input('room-lab');
            $subject->schedule = $request->input('schedule');
            $subject->sy = $request->input('sy');
            $subject->sem = $request->input('sem');
            $subject->save();

            $success_output = '<p class="m-0">Subject Updated!</p>';
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
        return DataTables::of(Subject::latest()->get())
                ->addColumn('category',function($data){
                    $categories = Option::where('type','subject-category')->get();
                    $subjectCategory = '';
                    foreach($categories as $category){
                        if($category->id == $data->category){
                            $subjectCategory = $category->name;
                        }
                    }
                    return $subjectCategory;
                })
                ->addColumn('instructor',function($data){
                    $instructors = Profile::select('id','first_name','last_name')->where('type', '1')->get();
                    $subjectInstructor = '';
                    foreach($instructors as $instructor){
                        if($instructor->id == $data->instructor){
                            $subjectInstructor = $instructor->first_name.' '.$instructor->last_name;
                        }
                    }
                    return $subjectInstructor;
                })
                ->addColumn('schedule',function($data){
                    $schedules = Schedule::all();
                    $locations = Option::where('type','room')->orWhere('type','lab')->get();

                    $subjectSchedule = '';
                    $subjectLocation = '';

                    foreach($schedules as $schedule){
                        if($schedule->id == $data->schedule){
                            $subjectSchedule = $schedule->schedule;
                        }
                    }

                    foreach($locations as $location){
                        if($location->id == $data->location){
                            $subjectLocation = $location->name;
                        }
                    }

                    $output = $subjectLocation.'('.$subjectSchedule.')';
                    return $output;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-warning editSubject">
                                        <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="" data-id="'.$data->id.'" class="btn btn-sm btn-danger deleteSubject">
                                        <i class="fas fa-trash"></i>
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','category'])
                ->make(true);
    }

    public function enrollSubjects()
    {
        if(request()->ajax())
        {
            return DataTables::of(Subject::latest()->get())
                ->addColumn('instructor',function($data){
                    $instructors = Profile::select('id','first_name','last_name')->where('type', '1')->get();
                    $subjectInstructor = '';
                    foreach($instructors as $instructor){
                        if($instructor->id == $data->instructor){
                            $subjectInstructor = $instructor->first_name.' '.$instructor->last_name;
                        }
                    }
                    return $subjectInstructor;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-primary enrollSubject">
                                        <i class="fas fa-plus"></i> Enroll
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','instructor'])
                ->make(true);
        }
    }
}
