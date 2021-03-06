@extends('layouts.admin')

@section('title', 'Grades for '.$profile->first_name.' '.$profile->last_name)
@section('menu-title', 'Grades for '.$profile->first_name.' '.$profile->last_name)

@section('styles')
<style>
    .uploaded-doc{
        height: 300px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        border: 15px solid #fff;
    }

    .uploaded-doc p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }

    #profile-pic,
    #enroll-profile-pic{
        height: 250px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    #profile-pic p,
    #enroll-profile-pic p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }

    #reject-reason{
        width: 100%;
    }

    #course{
        font-size: 2em;
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row mt-5">
            {{-- Personal Information --}}
            <div class="col-12 col-md-3 mb-3">
                <div class="thumbnail">
                    <img src="{{ $profile->profile_pic == 'No Data' ? asset('admin/img/empty-profile-img.png') : asset('storage/uploads/applicant-img/'.$profile->profile_pic) }}" alt="User Image" id="print-applicant-img" class="img-responsive" width="100%">
                    <div class="caption">
                        <p class="bg-danger text-white py-2 text-center">Profile Picture</p>
                    </div>
                </div>
            </div>
            <div class="col-9 print-col-8">
                <h5 class="border-bottom">Personal Information</h5>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Name: 
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-fullname">
                        {{ $profile->first_name.' '.$profile->last_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Contact:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-contact">
                        {{ $profile->contact_number }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Gender:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-gender">
                        @if($profile->gender == 0)
                            No Data
                        @elseif($profile->gender == 1)
                            Male
                        @elseif($profile->gender ==2 )
                            Female
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Civil Status:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-civil-status">
                        @if($profile->civil_status == 0)
                            No Data
                        @elseif($profile->civil_status == 1)
                            Single
                        @elseif($profile->civil_status == 2)
                            Married
                        @elseif($profile->civil_status == 3)
                            Widow
                        @elseif($profile->civil_status == 4)
                            Widower
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Religion:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-religion">
                        {{ $profile->religion }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Address:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-physical-address">
                        {{ $profile->purok ? 'Purok '.$profile->purok.',' : '' }} {{ $profile->sitio ? 'Sitio '.$profile->sitio.',' : '' }} {{ $profile->barangay }}, {{ $profile->municipality }}, {{ $profile->province }} {{ $profile->zipcode }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        School Id:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold text-danger" id="print-school-id">
                        {{ $profile->school_id == 0 ? 'No Data' : $profile->school_id }}
                    </div>
                </div>
                <div class="row mt-2 mb-md-0 mb-4">
                    <div class="col-12 font-weight-bold">
                        <h5 class="text-danger my-0 font-weight-bold" id="print-course">
                            <div class="d-md-block d-none">
                                @if($profile->course == 0)
                                    No Data
                                @elseif($profile->course == 1)
                                    Bachelor of Science in Information Technology | BSIT
                                @elseif($profile->course == 2)
                                    Bachelor in Elementary Education | BEED
                                @elseif($profile->course == 3)
                                    Bachelor in Secondary Education major in Mathematics | BSED-Math
                                @elseif($profile->course == 4)
                                    Bachelor in Secondary Education major in Social Studies | BSED-SocStu
                                @endif
                            </div>
                            <div class="d-block d-md-none">
                                @if($profile->course == 0)
                                    No Data
                                @elseif($profile->course == 1)
                                    BSIT
                                @elseif($profile->course == 2)
                                    BEED
                                @elseif($profile->course == 3)
                                    BSED-Math
                                @elseif($profile->course == 4)
                                    BSED-SocStu
                                @endif
                            </div>
                        </h5>
                    </div>
                    <div class="col-12 font-weight-bold my-0" id="print-gender">
                        <h5 class="my-0" id="print-year-level">
                            @if($profile->year_level == 0)
                                No Data
                            @elseif($profile->year_level == 1)
                                First Year
                            @elseif($profile->year_level == 2)
                                Second Year
                            @elseif($profile->year_level == 3)
                                Third Year
                            @elseif($profile->year_level == 4)
                                Fourth Year
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 border-bottom">
                <h5>Emergency Contacts</h5>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                Name:
            </div>
            <div class="col-12 col-md-7 font-weight-bold" id="print-parent-name">
                {{ $profile->emergency_contact_name }}
            </div>
            <div class="col-12 col-md-3 font-weight-bold" id="print-parent-contact">
                {{ $profile->emergency_contact_number }}
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 border-bottom">
                <h5>Educational History</h5>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                LRN:
            </div>
            <div class="col-12 col-md-10 font-weight-bold text-danger" id="print-lrn">
                {{ $profile->lrn }}
            </div>
            
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                School Graduated:
            </div>
            <div class="col-12 col-md-7 font-weight-bold" id="print-school-graduated">
                {{ $profile->school_graduated }}
            </div>
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                Year Graduated:
            </div>
            <div class="col-12 col-md-1 text-md-right font-weight-bold " id="print-year-graduated">
                {{ $profile->year_graduated }}
            </div>
            
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                School Address:
            </div>
            <div class="col-12 col-md-10 font-weight-bold" id="print-school-address">
                {{ $profile->school_address }}
            </div>
        </div>
        <form action="" id="filterGradeForm" method="POST">
            @csrf
            <div class="row mt-3">
                <div class="col-12">
                    <h5 class="bg-primary py-1 text-white text-center">Enrolled Subjects</h5>
                </div>
                <div class="col-12 col-md-2 py-1 no-print">Filter Options</div>
                @foreach ($semesters as $semester)
                    <div class="col-12 col-md-2 py-1 no-print">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="semester" value="{{ $semester->id }}">{{ $semester->name }} Sem
                            </label>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 col-md-4 no-print">
                    <div class="form-group">
                        <select name="school-year" id="school-year" class="form-control form-control-sm">
                            <option value="" selected disabled>Select School Year</option>
                            @foreach($school_years as $school_year)
                                <option value="{{ $school_year->id }}">{{ $school_year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-2 no-print">
                    <button type="submit" id="btnFilter" class="btn btn-info btn-block btn-sm" data-id="{{ $profile->id }}"><i class="fas fa-filter"></i> Filter</button>
                </div>
                <div class="col-12 table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Code</th>
                                <th scope="col">Description</th>
                                <th scope="col">Clearance</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Re-exam</th>
                            </tr>
                        </thead>
                        <tbody id="subjectListItems">
                            @php $count = 1; @endphp
                            @foreach($givenGrade as $grade)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $grade['code'] }}</td>
                                    <td>{{ $grade['description'] }}</td>
                                    <td>
                                        @if($grade['clearance'] == 'Not Cleared')
                                            <span class="badge badge-danger">Not Cleared</span>
                                        @else
                                            <span class="badge badge-success">Cleared</span>
                                        @endif
                                    </td>
                                    <td class="
                                        {{ $grade['grade'] == 'No Grade Yet' ? 'font-weight-bold text-warning' : 'font-weight-bold text-success'}}
                                        {{ $grade['grade'] == '5.0' ? 'font-weight-bold text-danger' : 'font-weight-bold text-success'}}
                                        {{ $grade['grade'] == 'NG' ? 'font-weight-bold text-info' : 'font-weight-bold text-success'}}
                                    ">
                                        {{ $grade['grade'] }}
                                    </td>
                                    <td>{{ $grade['reexam'] }}</td>
                                </tr>
                                @php $count++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <p class="text-center bg-danger text-white p-2">This is a system generated report. If you need a signed version of this report. Please visit the registrar's office.</p>
        <div class="row mt-5">
            <div class="col-12 col-md-4">
                <h5>Approved by:</h5>
                {{-- <img src="{{ asset('admin/img/registrar-signature-no-bg.png') }}" alt="Registrar's Signature" width="50%" id="registrarSignature"> --}}
                <h5 class="mb-0 mt-5 text-uppercase font-weight-bold border-bottom">Emma Roa Wagas, MBA</h5>
                <p class="m-0">School Registrar</p>
            </div>
        </div>
        <div class="row my-5 no-print">
            <div class="col-12 col-md-2">
                <button id="printCOR" class="btn btn-warning btn-block">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.students.partials.scripts.actions')
@endsection