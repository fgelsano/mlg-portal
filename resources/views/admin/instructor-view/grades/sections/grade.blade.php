@extends('layouts.admin')

@section('title', 'Grades in '. $subject->code)
@section('menu-title', 'Grades in '. $subject->code)

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="row mt-1">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('instructor-grades.show', Auth::user()->profile_id) }}">Grades</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $subject->code }} | {{ $subject->description }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-12 col-md-6">
                        <p class="m-0"><strong>Code: </strong> {{ $subject->code }}</p>
                        <p class="m-0"><strong>Description: </strong>{{ $subject->description }}</p>
                        <p class="m-0"><strong>Subject Type: </strong>{{ $subject->type == '0' ? 'Lecture' : 'Laboratory' }}</p>
                        <p class="m-0"><strong>Units: </strong>{{ $subject->units }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="m-0"><strong>Schedule: </strong>{{ $subject->day }}</p>
                        <p class="m-0"><strong>Time & Location: </strong>{{ $subject->time . ' ' . $subject->location }}</p>
                        <p class="m-0"><strong>Semester: </strong>{{ $subject->sem == '1' ? 'First Sem' : 'Second Sem' }}</p>
                        <p class="m-0"><strong>Academic Year: </strong> {{ $subject->ay }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-warning py-1">
                            Legend:
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-12 col-md-2">
                        <p class="m-0">100 = 1.0</p>
                        <p class="m-0">99 = 1.0</p>
                        <p class="m-0">98 = 1.1</p>
                        <p class="m-0">97 = 1.1</p>
                        <p class="m-0">96 = 1.2</p>
                    </div>
                    <div class="col-12 col-md-2">
                        <p class="m-0">95 = 1.2</p>
                        <p class="m-0">94 = 1.3</p>
                        <p class="m-0">93 = 1.3</p>
                        <p class="m-0">92 = 1.4</p>
                        <p class="m-0">91 = 1.4</p>
                    </div>
                    <div class="col-12 col-md-2">
                        <p class="m-0">90 = 1.5</p>
                        <p class="m-0">89 = 1.6</p>
                        <p class="m-0">88 = 1.7</p>
                        <p class="m-0">87 = 1.8</p>
                        <p class="m-0">86 = 1.9</p>
                    </div>
                    <div class="col-12 col-md-2">
                        <p class="m-0">85 = 2.0</p>
                        <p class="m-0">84 = 2.1</p>
                        <p class="m-0">83 = 2.2</p>
                        <p class="m-0">82 = 2.3</p>
                        <p class="m-0">81 = 2.4</p>
                    </div>
                    <div class="col-12 col-md-2">
                        <p class="m-0">80 = 2.5</p>
                        <p class="m-0">79 = 2.6</p>
                        <p class="m-0">78 = 2.7</p>
                        <p class="m-0">77 = 2.8</p>
                        <p class="m-0">76 = 2.9</p>
                    </div>
                    <div class="col-12 col-md-2 text-md-right">
                        <p class="m-0">75 = 3.0</p>
                        <p class="m-0">74.99 below = 5.0</p>
                        <p class="m-0">INC = INC</p>
                        <p class="m-0">DROPPED = DR</p>
                        <p class="m-0">NO GRADE = NG</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 table-responsive">
                        <form action="" id="grades" method="" data-subject="{{ $subject->id }}">
                        @csrf
                        <table class="table table-sm">
                            <thead>
                                <tr class="table-primary py-3">
                                    <th scope="col" class="py-3">#</th>
                                    <th scope="col" class="py-3">Id</th>
                                    <th scope="col" class="py-3">Last Name</th>
                                    <th scope="col" class="py-3">First Name</th>
                                    <th scope="col" class="py-3">Grade</th>
                                    <th scope="col" class="py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach($students as $key => $student)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $student->school_id }}</td>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->first_name }}</td>
                                        <td>
                                            @if($student->grade == null)
                                                <input type="text" name="grade[{{$student->profile_id}}]" id="{{$student->grade_id}}" value="{{ isset($student->grade) ? $student->grade : '' }}" maxlength="3">
                                            @else
                                                <p class="m-0" id="grade-{{$student->grade_id}}">{{$student->grade}}</p>
                                                <input type="hidden" name="grade[{{$student->profile_id}}]" id="{{$student->grade_id}}" value="{{ isset($student->grade) ? $student->grade : '' }}" maxlength="3">
                                            @endif
                                        </td>
                                        <td>
                                            @if($student->grade == null)
                                                <p class="m-0 text-danger">No Grade</p>
                                            @else
                                                @if(Auth::user()->role == 4 || Auth::user()->role == 5)
                                                    <button class="btn btn-info btn-sm btnEditGrade" data-grade-id="{{$student->grade_id}}"><i class="fa fa-edit mr-1"></i>Edit</button>
                                                @endif
                                            @endif
                                            @if(Auth::user()->role == 4 || Auth::user()->role == 5)
                                                <button type='submit' class="btn btn-info btn-sm {{$student->grade_id}} d-none btnUpdateGrade" data-grade-id="{{$student->grade_id}}"><i class="fa fa-edit mr-1"></i>Update</button>
                                                <button class="btn btn-danger btn-sm {{$student->grade_id}} d-none btnCancelEdit-{{$student->grade_id}}" data-grade-id="{{$student->grade_id}}"><i class="fa fa-times mr-1"></i>Cancel</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @php $count++ @endphp
                                @endforeach
                            </tbody>
                        </table>
                        </form>
                        @if(Auth::user()->role == 4 || Auth::user()->role == 5)
                            <button class="btn btn-primary btn-sm px-5" id="saveGrades"><i class="fa fa-save mr-1"></i>Save</button>
                        @endif
                    </div>
                </div>
                {{-- <div class="alert bg-danger text-white mt-5">
                    <strong>File Upload:</strong> please upload a scanned or image file of the printed version of your gradesheet showing your signature.
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 my-3">
                        <div class="form-group ">
                            <input type="file" class="dropify" id="profile-pic" name="profile-pic">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 my-3">
                        <p class="m-0 border-bottom mb-3">Filename/s:</p>
                        <div class="filenames">
                            <p class="text-danger m-0">Filename 1</p>
                            <p class="text-danger m-0">Filename 2</p>
                            <p class="text-danger m-0">Filename 3</p>
                        </div>
                        <button class="btn btn-info btn-save btn-block mt-3"><i class="fa fa-save mr-1"></i>Save</button>
                    </div>
                </div> --}}
                {{-- <p class="text-center bg-danger text-white py-2">This is a system generated report. Please visit the registrar's office personally if you want it signed by the registrar.</p> --}}
                
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.instructor-view.grades.scripts.actions')
@endsection