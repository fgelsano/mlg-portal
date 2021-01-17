<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Francis Gelsano">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MLGCL | Online Admission</title>
    @include('front.partials._external-styles')
    @include('front.partials._internal-styles')

    <meta property="og:image" content="{{ asset('admin/img/MLG_Logo-Since-1999.jpg')}}" />
    <meta property="og:image:width" content="450"/>
    <meta property="og:image:height" content="298"/>

</head>

<body>
    <div class="main">
        <div class="container">
            {{-- Confirmation Section --}}
            <div class="alert alert-success p-5" id="admission-submitted">
                <h4 class="mb-3">Thank you for applying admission at MLG College of Learning, Inc!</h4>
                <p class="mb-0">Your application request has been submitted and now pending review by the registrar's office.</p>
                <hr>
                <h3 class="font-weight-bold text-danger">Important Reminder!</h3>
                <div class="row mb-3 mb-md-0">
                    <div class="col-12 col-md-9">
                        <p class="mb-0 font-weight-bold mb-3">Please pay your miscellaneous fee via the following payment options listed below. Once payment is confirmed, the registrar will start loading your subjects into your student portal.</p>
                        <div class="row">
                            <div class="col-12 col-md-3">Cashier's Office</div>
                            <div class="col-12 col-md-9"><a href="https://mlgcl.edu.ph/docs/how-to-pay-at-the-cashiers-office/" target="_blank">https://mlgcl.edu.ph/docs/how-to-pay-at-the-cashiers-office/</a></div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">MLhuillier</div>
                            <div class="col-12 col-md-9"><a href="https://mlgcl.edu.ph/docs/how-to-pay-using-mlhuillier/" target="_blank">https://mlgcl.edu.ph/docs/how-to-pay-using-mlhuillier/</a></div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">Cebuana Lhuillier</div>
                            <div class="col-12 col-md-9"><a href="https://mlgcl.edu.ph/docs/how-to-pay-using-cebuana-lhuillier/" target="_blank">https://mlgcl.edu.ph/docs/how-to-pay-using-cebuana-lhuillier/</a></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <p class="text-center bg-danger text-white py-1">Miscellaneous Fee</p>
                        <h1 class="text-center" id="totalMiscFee">₱{{ $enrollmentFee }}</h1>
                    </div>
                </div>
                <hr>
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
                    <div class="col-12 col-md-9 print-col-8">
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
                                    {{ $profile->name }} ({{ $profile->code }})
                                </h4>
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
                        {{ $profile->lrn == '0' ? 'NO LEARNER\'S REFERENCE NUMBER' : $profile->lrn }}
                    </div>
                    
                    <div class="col-12 col-md-2 d-none d-md-block print-show">
                        <p class="m-0">School Graduated:</p>
                        <p class="m-0">School Address:</p>
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold" id="print-school-graduated">
                        <p class="m-0">{{ $profile->school_graduated }}</p>
                        <p class="m-0">{{ $profile->school_address }}</p>
                    </div>
                    <div class="col-12 col-md-2 d-none d-md-block print-show">
                        <p class="m-0">Year Graduated:</p>                        
                    </div>
                    <div class="col-12 col-md-1 text-md-right font-weight-bold " id="print-year-graduated">
                        <p class="m-0">{{ $profile->year_graduated }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>