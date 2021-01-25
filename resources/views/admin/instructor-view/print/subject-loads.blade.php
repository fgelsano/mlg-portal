@extends('admin.instructor-view.print.index')

@section('title', 'Subject Load | ')

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
    <div class="container">
        <div class="row py-5 my-3 border-bottom">
            <div id="logo" class="col-12 col-md-1 text-right" style="background-image: url({{ asset('admin/img/MLG_Logo-Since-1999.jpg') }})"></div>
            <div class="col-12 col-md-6 px-0">
                <h5 class="merriweather font-weight-bold m-0">MLG College of Learning, Inc</h5>
                <p class="m-0 merriweather">Brgy. Atabay, Hilongos, Leyte</p>
            </div>
            <div class="col-12 col-md-5 text-right px-0 d-flex flex-column align-items-end align-self-end font-weight-bold">
                <h3 class="text-uppercase merriweather m-0">Subject Load</h3>
            </div>
        </div>
    
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
                    <div class="col-12 col-md-4 font-weight-bold" id="print-fullname">
                        {{ $profile->first_name.' '.$profile->last_name }}
                    </div>
                    
                    <div class="col-12 col-md-5 font-weight-bold text-right">
                        <span class="text-danger my-0 font-weight-bold" id="print-course">
                            @if(Auth::user()->role == 0)
                                System Administrator
                            @endif
                            @if(Auth::user()->role == 4)
                                Full Time Instructor
                            @endif
                            @if(Auth::user()->role == 5)
                                Part Time Instructor
                            @endif
                        </span>
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
                <div class="row mt-3">
                    <div class="col-12 border-bottom">
                        <h5>Emergency Contacts</h5>
                    </div>
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Name:
                    </div>
                    <div class="col-12 col-md-6 font-weight-bold" id="print-parent-name">
                        {{ $profile->emergency_contact_name }}
                    </div>
                    <div class="col-12 col-md-3 font-weight-bold text-right" id="print-parent-contact">
                        {{ $profile->emergency_contact_number }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <h5 class="bg-primary py-2 text-white text-center">Subject Load</h5>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr class="table-primary py-3">
                            <th scope="col" class="py-3">#</th>
                            <th scope="col" class="py-3">Code</th>
                            <th scope="col" class="py-3">Description</th>
                            <th scope="col" class="py-3">Schedule</th>
                            <th scope="col" class="py-3">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($subjects $subject)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->description }}</td>
                                <td>
                                    @foreach ($schedules as $schedule)
                                        @if ($schedule->id == $subject->schedule)
                                            {{ $schedule->day }} ({{ $schedule->time }}) at 
                                            @if($schedule->type == 0)
                                                Room {{ $schedule->location }}
                                            @elseif($schedule->type == 1)
                                                Lab {{ $schedule->location }}
                                            @else
                                                Home
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $subject->units }}</td>
                            </tr> 
                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="row mb-3">
                    <div class="col-8 col-md-2 offset-9 text-right">
                        Total Units: 
                    </div>
                    <div class="col-4 col-md-1 text-center font-weight-bold">
                        {{ $totalUnits }}
                    </div>
                </div>
            </div>
        </div>
        
        <p class="text-center bg-danger text-white py-2">This is a system generated report.</p>
        
        <div class="row my-5 no-print">
            <div class="col-12 col-md-2 offset-md-5">
                <button id="printCOR" class="btn btn-warning btn-block">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
@endsection