<?php

namespace App\Http\Controllers\Dashboard\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;

use DataTables;
use Validator;
use Illuminate\Support\Str;

use App\Models\Subject;
use App\Models\Option;
use App\Models\Profile;
use App\Models\Schedule;
use App\User;

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
            'url'           => 'required',
            'instructor'    => 'required',
            'subjectType'   => 'required',
            'academic-year' => 'required',
            'sem'           => 'required',
            'units'         => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
            return response()->json([
                'error' => $error_array,
            ],414);
        } else {
            
            // create instructor
            $subject = new Subject;
            $subject->code = $request->input('code');
            $subject->description = $request->input('description');
            $subject->url = $request->input('url');
            $subject->category = $request->input('category');
            $subject->instructor = $request->input('instructor');
            $subject->schedule = $request->input('schedule');
            $subject->units = $request->input('units');
            $subject->type = $request->input('subjectType');
            $subject->academic_year = $request->input('academic-year');
            $subject->semester = $request->input('sem');
            $subject->status = 0;
            $subject->save();

            if(!$subject->save()){
                return response()->json([
                    'error' => $subject,
                ],414);
            }

            return response()->json([
                'success' => 'Subject Added!',
                'data' => $subject
            ],200);
        }
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
            $subject = Subject::select('subjects.id','subjects.code','subjects.description','subjects.units','profiles.last_name','profiles.first_name','schedules.*')
                                ->join('schedules','subjects.schedule','=','subjects.schedule')
                                ->join('profiles','subjects.instructor','=','profiles.id')
                                ->where('subjects.id',$id)
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
            $subject = Subject::where('subjects.id', $id)
                        ->join('schedules','subjects.schedule','=','schedules.id')
                        ->select('schedules.*','subjects.*','schedules.type as locationType')
                        ->first();
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
            'url'           => 'required',
            'instructor'    => 'required',
            'subjectType'   => 'required',
            'academic-year' => 'required',
            'sem'           => 'required',
            'units'         => 'required'
        ]);

        $error_array = array();
        $success_output = '';


        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
            return response()->json([
                'error' => $error_array,
            ],414);
        } else {
            
            // create instructor
            $subject = Subject::where('id', $id)->first();
            $subject->code = $request->input('code');
            $subject->description = $request->input('description');
            $subject->url = $request->input('url');
            $subject->category = $request->input('category');
            $subject->instructor = $request->input('instructor');
            $subject->schedule = $request->input('schedule');
            $subject->units = $request->input('units');
            $subject->type = $request->input('subjectType');
            $subject->academic_year = $request->input('academic-year');
            $subject->semester = $request->input('sem');
            $subject->status = 0;
            $subject->save();

            if(!$subject->save()){
                return response()->json([
                    'error' => $subject,
                ],414);
            }

            return response()->json([
                'success' => 'Subject Updated!',
                'data' => $subject
            ],200);
        }
    }

    public function updateInstructorSubject(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'url'      => 'required',
            'status'   => 'required',
        ]);

        if($validation->fails()){
            return response()->json(
                $validation->getMessageBag()->toArray()
            ,400);
        } else {

            $subject = Subject::where('id', $id)->first();

            $subject->url = $request->input('url');
            $subject->status = $request->input('status');
            $subject->save();

            if(!$subject->save()){
                return response()->json([
                    'error' => $subject,
                ],400);
            }

            return response()->json([
                'success' => 'Subject Updated!',
                'data' => $subject
            ],200);
        }
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
                    $instructors = Profile::select('id','first_name','last_name')->where('role', 4)->orWhere('role',5)->get();
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

                    $subjectSchedule = '';

                    foreach($schedules as $schedule){
                        if($schedule->type == 0){
                            $locType = 'Room ';
                        } else if($schedule->type == 1){
                            $locType = 'Lab ';
                        } else {
                            $locType = 'Home ';
                        }
                        if($schedule->id == $data->schedule){
                            $subjectSchedule = $schedule->day.', '.$locType.$schedule->location.' ('.$schedule->time.')';
                        }
                    }
                    return $subjectSchedule;
                })
                ->addColumn('type', function($data){
                    $type = '';
                    
                    if($data->type == 0){
                        $type = '<span class="badge badge-primary">Lec</span>';
                    } else if($data->type == 1){
                        $type = '<span class="badge badge-warning">Lab</span>';
                    }
                    return $type;
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
                ->rawColumns(['action','category','instructor','schedule','type'])
                ->make(true);
    }

    public function enrollSubjects()
    {
        if(request()->ajax())
        {
            return DataTables::of(Subject::latest()->get())
                ->addColumn('instructor',function($data){
                    $instructors = Profile::select('id','first_name','last_name','role')
                                            ->where('role', 4)
                                            ->orWhere('role',5)
                                            ->get();
                    $subjectInstructor = '';
                    foreach($instructors as $instructor){
                        if($instructor->id == $data->instructor){
                            $subjectInstructor = $instructor->first_name.' '.$instructor->last_name;
                        }
                    }
                    return $subjectInstructor;
                })
                ->addColumn('description', function($data){
                    $description = Str::limit($data->description,20,'...');
                    return $description;
                })
                ->addColumn('type', function($data){
                    if($data->type == 0){
                        $type = '<span class="badge badge-primary">Lecture</span>';
                    } else {
                        $type = '<span class="badge badge-warning px-2">Lab</span>';
                    }

                    return $type;
                })
                ->addColumn('action', function($data){
                    $actionButtons = '<a href="" data-id="'.$data->id.'" class="btn btn-sm btn-primary enrollSubject" data-show="true">
                                        <i class="fas fa-plus"></i> Enroll
                                      </a>';
                    return $actionButtons;
                })
                ->rawColumns(['action','instructor','description','type'])
                ->make(true);
        }
    }
}
