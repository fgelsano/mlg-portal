@extends('layouts.admin')

@section('title', 'eClearance (  ' . $subject->code . ')')
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
                        <div class="col-12 col-md-6">
                            <nav aria-label="breadcrumb breadcrumb-sm">
                                <nav aria-label="breadcrumb">
                                <ol class="breadcrumb py-1 bg-white">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('instructor-clearances.show', Auth::user()->profile_id) }}">eClearance</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $subject->code }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-12 col-md-2 offset-md-2 input-group-sm">
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
                                    @php $count = 1; @endphp
                                    @foreach ($clearances->sortBy('last_name') as $key => $student)
                                        <tr>
                                            <td><input type="checkbox" name="studentId[{{ $key }}]" value="{{ $student->id }}" class="studentCheckBox"></td>
                                            <td>{{ $count }}</td>
                                            <td>{{ $student->school_id }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ $student->code }}</td>
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
                                            @if($student->clearanceId == Null)
                                                <td>
                                                    <button class="btn btn-sm btn-success approveStudent" data-student-id="{{ $student->id }}" data-subject="{{ $subject->id }}">
                                                        <i class="fas fa-check"></i> Approve Clearance
                                                    </button>
                                                </td>
                                            @else
                                                <td class="bg-info text-white text-center pb-0">
                                                    Cleared
                                                </td>
                                            @endif
                                        </tr>
                                        @php $count++ @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <p class="bg-danger text-center py-2 text-white">
                    This is a system-generated report. If you need a signed version, please bring a printed copy of this report to the school registrar.
                </p> --}}
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts')
    @include('admin.instructor-view.clearances.scripts.actions')
@endsection