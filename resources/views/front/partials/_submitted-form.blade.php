{{-- Submitted Form --}}
<div id="submitted-form" class="d-none">
    {{-- Print Button --}}
    <div class="col-12 col-md-4 offset-md-4 mt-5 mb-3">
        <button id="print-btn" class="btn btn-warning btn-block" onclick="printAdmission()">
            <i class="fas fa-print"></i>
            Print Admission Form
        </button>
    </div>

    <div id="printContents" class="p-5 border">
        {{-- Letter Head --}}
        <div class="row border-bottom py-3">
            <div class="col-12 col-md-1 print-col-2">
                <img src="{{ asset('storage/MLG_Logo-Since-1999.jpg') }}" alt="MLG Logo" class="img-responsive" width="100%" id="print-logo">
            </div>
            <div class="col-12 col-md-11">
                <div class="row">
                    <div class="col-12 col-md-6 text-center text-md-left print-col-6">
                        <p class="m-0 font-weight-bold">MLG College of Learning, Inc.</p>
                        <p class="small">Brgy. Atabay, Hilongos, Leyte</p>
                    </div>
                    <div class="col-12 col-md-6 print-col-8">
                        <h3 class="text-uppercase text-md-right text-center">Admission Form</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            {{-- Personal Information --}}
            <div class="col-12 col-md-8 print-col-8">
                <h5 class="border-bottom">Personal Information</h5>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Name:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-fullname">
                        Francis Engcoy Gelsano
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Gender:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-gender">
                        Male
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Civil Status:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-civil-status">
                        Married
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Religion:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-religion">
                        Born Again Christian
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Physical Address:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-physical-address">
                        #1 Sitio Manga, Sto. Niño Extension, Matalom, Leyte, Philippines, 6526
                    </div>
                </div>
            </div>
            {{-- Course Details --}}
            <div class="col-12 col-md-4 text-md-right mt-3 text-center mt-sm-3 print-col-4">
                <h5>Course Details</h5>
                <h1 class="text-danger my-0 font-weight-bold" id="print-course">BSIT</h1>
                <h6 class="my-0" id="print-year-level">First Year</h6>
                <div class="mt-4">
                    <h2 class="text-danger" id="print-trans-id"></h2>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 border-bottom">
                <h5>Emergency Contacts</h5>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                Name:
            </div>
            <div class="col-12 col-md-7 font-weight-bold" id="print-parent-name">
                Francisco Gelsano
            </div>
            <div class="col-12 col-md-3 font-weight-bold" id="print-parent-contact">
                0977-489-0473
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 border-bottom">
                <h5>Educational History</h5>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                LRN:
            </div>
            <div class="col-12 col-md-10 font-weight-bold text-danger" id="print-lrn">
                PH000000000012
            </div>
            
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                School Graduated:
            </div>
            <div class="col-12 col-md-7 font-weight-bold" id="print-school-graduated">
                MLG College of Learning, Inc.
            </div>
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                Year Graduated:
            </div>
            <div class="col-12 col-md-1 text-right font-weight-bold" id="print-year-graduated">
                2018
            </div>
            
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                School Address:
            </div>
            <div class="col-12 col-md-10 font-weight-bold" id="print-school-address">
                Brgy. Atabay, Hilongos, Leyte, Philippines
            </div>
        </div>
        <div class="row mt-5 py-3 border-bottom">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 border-bottom">
                        <h5>Uploaded Documents</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 col-md-2 my-3 text-center print-col-1" id="print-med-cert">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="col-10 col-md-10 my-3 print-col-11">
                        Medical Certificate
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 col-md-2 my-3 text-center print-col-1" id="print-gmc">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="col-10 col-md-10 my-3 print-col-11">
                        Good Moral Character
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 col-md-2 my-3 text-center print-col-1" id="print-sf9-front">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="col-10 col-md-10 my-3 print-col-11">
                        SF9 or Form 138 [FRONT VIEW]
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 col-md-2 my-3 text-center print-col-1" id="print-sf9-back">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="col-10 col-md-10 my-3 print-col-11">
                        SF9 or Form 138 [BACK VIEW]
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 col-md-2 my-3 text-center print-col-1" id="print-gwa">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="col-10 col-md-10 my-3 print-col-11">
                        GWA Certification
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 col-md-2 my-3 text-center print-col-1" id="print-psa-bc">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="col-10 col-md-10 my-3 print-col-11">
                        PSA Birth Certificate [NSO]
                    </div>
                </div>
                <div class="row">
                    <div class="col-2 col-md-2 my-3 text-center print-col-1" id="print-hd">
                        <i class="fas fa-check text-success"></i>
                    </div>
                    <div class="col-10 col-md-10 my-3 print-col-11">
                        Honorable Dismissal
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 border-bottom">
                        <h5>Applicant Image</h5>
                    </div>
                </div>
                <img src="" alt="Applicant Image" id="print-applicant-img" class="img-responsive" width="100%">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h1 class="text-danger font-weight-bold text-uppercase">
                    Pending Review
                </h1>
            </div>
        </div>
    </div>
</div>