@extends('layouts.admin')

@section('title', 'Billing')
@section('menu-title', 'Billing')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="bg-danger text-white text-center p-3 no-print">
        <strong>Disclaimer:</strong> This module is still at <strong>Beta Version</strong>. Some computations may not be accurate. Contact the cashier for clarifications.
    </div>
    

    <div class="card-body bg-white">
        <div class="row mt-5">
            {{-- Personal Information --}}
            <div class="col-12 col-md-3 mb-3">
                <div class="thumbnail">
                    <img src="{{ $profile->profile_pic == 'No Data' ? asset('admin/img/empty-profile-img.png') : asset('storage/uploads/applicant-img/'.$profile->profile_pic) }}" alt="User Image" id="print-applicant-img" class="img-responsive" width="100%">
                </div>
            </div>
            <div class="col-9 print-col-8">
                <h5 class="border-bottom">Personal Information</h5>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        School Id:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold text-danger" id="print-school-id">
                        {{ $profile->school_id == 0 ? 'No Data' : $profile->school_id }}
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        First Name: 
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-fullname">
                        {{ $profile->first_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Middle Name: 
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-fullname">
                        {{ $profile->middle_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Last Name: 
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-fullname">
                        {{ $profile->last_name }}
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Contact Number: 
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-fullname">
                        {{ $profile->contact_number }}
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
                <div class="row mt-2 mb-md-0 mb-4">
                    <div class="col-12 font-weight-bold">
                        <h4 class="text-danger my-0 font-weight-bold" id="print-course">
                            <div class="d-md-block d-none">
                                @if($profile->year_level == 0)
                                    No Data
                                @elseif($profile->year_level == 1)
                                    1<sup>st</sup> Year
                                @elseif($profile->year_level == 2)
                                    2<sup>nd</sup> Year
                                @elseif($profile->year_level == 3)
                                    3<sup>rd</sup> Year
                                @elseif($profile->year_level == 4)
                                    4<sup>th</sup> Year
                                @endif
                                {{ $profile->course }}
                            </div>
                            <div class="d-block d-md-none">
                                @if($profile->year_level == 0)
                                    No Data
                                @elseif($profile->year_level == 1)
                                    1st Year
                                @elseif($profile->year_level == 2)
                                    2nd Year
                                @elseif($profile->year_level == 3)
                                    3rd Year
                                @elseif($profile->year_level == 4)
                                    4th Year
                                @endif
                                {{ $profile->course }}
                            </div>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-danger text-white text-center px-5 py-2 text-uppercase">
            Billing Details
        </div>
        <div id="billing-details" class="border py-5 px-3">
            <div class="py-1 mb-0 border-bottom font-weight-bold">
                A. Tuition Fees
            </div>
            @foreach ($bills as $bill)
                @if (substr($bill->fee,0,1) == 'A')
                    <div class="row py-1">
                        <div class="col-8 text-right">
                            {{ substr($bill->fee, 3) }}
                        </div>
                        <div class="col-4 text-right">
                            ₱{{ $bill->amount }}
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="py-1 mb-0 border-bottom font-weight-bold">
                B. Miscellaneous Fees
            </div>
            @foreach ($bills as $bill)
                @if (substr($bill->fee,0,1) == 'B')
                    <div class="row py-1">
                        <div class="col-8 text-right">
                            {{ substr($bill->fee, 3) }}
                        </div>
                        <div class="col-4 text-right">
                            ₱{{ $bill->amount }}
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="py-1 mb-0 border-bottom font-weight-bold">
                C. Development Fees
            </div>
            @foreach ($bills as $bill)
                @if (substr($bill->fee,0,1) == 'C')
                    <div class="row py-1">
                        <div class="col-8 text-right">
                            {{ substr($bill->fee, 3) }}
                        </div>
                        <div class="col-4 text-right">
                            ₱{{ $bill->amount }}
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="py-1 mb-0 border-bottom font-weight-bold">
                D. Other Fees
            </div>
            @foreach ($bills as $bill)
                @if (substr($bill->fee,0,1) == 'D')
                    <div class="row py-1">
                        <div class="col-8 text-right">
                            {{ substr($bill->fee, 3) }}
                        </div>
                        <div class="col-4 text-right">
                            ₱{{ $bill->amount }}
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="row mt-3">
                <div class="col-8 text-right text-uppercase font-weight-bold">
                    Total
                </div>
                <div class="col-4 text-right font-weight-bold text-danger border-bottom">
                    <h4>₱{{ number_format($totalBill,2) }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-8 text-right">
                    <i>less:</i>
                </div>
                <div class="col-4 text-right">
                    (₱{{ number_format($payment->amount,2) }})
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-8">
                    <h5 class="m-0">Note:</h5>
                    <p>{{ $payment->others }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-print mt-3 p-3">
        <div class="col-12 col-md-2">
            <button id="printCOR" class="btn btn-warning btn-block">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
@endsection