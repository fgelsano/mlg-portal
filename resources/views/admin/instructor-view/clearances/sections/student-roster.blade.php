@extends('layouts.admin')

@section('title', 'eClearance | Student Roster')
@section('menu-title', 'Student Clearance | ' . $subject->code)

@section('styles')
<style>
    .merriweather{
        font-family: 'Merriweather', serif;
    }
    #logo{
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    @media print {
        .no-print{
            display: none;
        }
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form action="" id="clearStudents" method="">
            @csrf
            <input type="hidden" name="subjectId" value="{{ $subject->id }}">
            <div class="container px-0">
                <div class="card border-0">
                    <div class="row px-3 pt-3">
                        <div class="col-12 col-md-2 offset-md-8 input-group-sm">
                            <button class="btn btn-sm btn-danger btn-block updateBtn" id="btnNotCleared" disabled data-action="Disapprove">
                                <i class="fas fa-times mr-2"></i> Disapprove
                            </button>
                        </div>
                        <div class="col-12 col-md-2">
                            <button class="btn btn-sm btn-success btn-block updateBtn" id="btnCleared" disabled data-action="Approve">
                                <i class="fas fa-check mr-2"></i> Approve
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="students" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="selectAll" id="selectAll"></th>
                                        <th>#</th>
                                        <th>Student Id</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Course</th>
                                        <th>Year</th>
                                        <th class="no-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)
                                        <tr>
                                            <td><input type="checkbox" name="studentId[{{ $key }}]" value="{{ $student->student_id }}" class="studentCheckBox"></td>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $student->school_id }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ $student->course }}</td>
                                            <td>
                                                @if ($student->year_level == 1)
                                                    1st Year
                                                @elseif ($student->year_level == 2)
                                                    2nd Year
                                                @elseif ($student->year_level == 3)
                                                    3rd Year
                                                @elseif ($student->year_level == 4)
                                                    4th Year
                                                @endif
                                            </td>
                                            @if($student->studentId == Null && $student->subjectId == Null)
                                                <td>
                                                    <button class="btn btn-sm btn-success approveStudent" data-student-id="{{ $student->student_id }}" data-subject="{{ $subject->id }}">
                                                        <i class="fas fa-check"></i> Approve Clearance
                                                    </button>
                                                </td>
                                            @else
                                                <td class="bg-info text-white text-center pb-0">
                                                    Cleared
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p class="bg-danger text-center py-2 text-white">
                    This is a system-generated report. If you need a signed version, please bring a printed copy of this report to the school registrar.
                </p>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts')
    @include('admin.instructor-view.clearances.scripts.actions')
@endsection