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
                <div class="merriweather p-3 d-none text-center border-bottom mb-1" id="letterhead">
                    <img src="{{ asset('admin/img/MLG_Logo-Since-1999.jpg') }}" width="10%">
                    <h3 class="mb-0">MLG College of Learning, Inc</h3>
                    <p class="mb-3">Brgy. Atabay, Hilongos, Leyte</p>
                    <h3 class="text-uppercase mb-3">Grade Sheet</h3>
                </div>
                <div class="row mt-1 no-print">
                    <div class="col-12 no-print">
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
                        <p class="m-0"><strong>Semester: </strong>{{ $subjectAySem['sem'] }}</p>
                        <p class="m-0"><strong>Academic Year: </strong> {{ $subjectAySem['ay'] }}</p>
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
                                        <th scope="col" class="py-3">Re-exam</th>
                                        <th scope="col" class="py-3 no-print">Actions</th>
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
                                                    <p id="grade-{{$student->grade_id}}" class="m-0 {{$student->grade == '5.0' ? 'text-danger' : ''}} {{$student->grade == 'INC' ? 'text-warning' : ''}} {{$student->grade == 'NG' ? 'text-primary' : ''}}">{{$student->grade}}</p>
                                                    <input type="hidden" name="grade[{{$student->profile_id}}]" id="{{$student->grade_id}}" value="{{ isset($student->grade) ? $student->grade : '' }}" maxlength="3">
                                                @endif
                                            </td>                                        
                                            <td>
                                                @if($student->reexam != null)
                                                    {{ $student->reexam }}
                                                @elseif($student->grade == 'INC')
                                                    <input type="text" name="reexam[{{$student->profile_id}}]" id="reexam-{{$student->grade_id}}" value="" maxlength="3">
                                                @else
                                                    <p class="reexam-na mb-0">N/A</p>
                                                @endif
                                            </td>
                                            <td class="no-print">
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
                        <div id="instructor">
                            <div class="row mt-5">
                                <div class="col-12 col-md-4 border-bottom text-uppercase font-weight-bold">
                                    {{ $subject->first_name }} {{ $subject->last_name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    Subject Instructor
                                </div>
                            </div>
                        </div>
                        
                        @if(Auth::user()->role == 4 || Auth::user()->role == 5 || Auth::user()->role == 1)
                            <div class="row my-3 no-print">    
                                <div class="col-12 col-md-2">
                                    <button class="btn btn-primary btn-block no-print" id="saveGrades">
                                        <i class="fa fa-save mr-1"></i>Save
                                    </button>
                                </div>
                                <div class="col-12 col-md-2">
                                    <button id="printCOR" class="btn btn-warning btn-block no-print">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts')
    @include('admin.instructor-view.grades.scripts.actions')
@endsection