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
        <div class="row mt-4 mb-md-0 mb-4">
            <div class="col-12 font-weight-bold">
                <h4 class="text-danger my-0 font-weight-bold" id="print-course">
                    <div class="">
                        @if($profile->course == 0)
                            No Data
                        @elseif($profile->course == 1)
                            Bachelor of Science in Information Technology
                        @elseif($profile->course == 2)
                            Bachelor in Elementary Education
                        @elseif($profile->course == 3)
                            Bachelor in Secondary Education major in Mathematics
                        @elseif($profile->course == 4)
                            Bachelor in Secondary Education major in Social Studies
                        @endif
                    </div>
                </h4>
            </div>
            <div class="col-12 font-weight-bold my-0">
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