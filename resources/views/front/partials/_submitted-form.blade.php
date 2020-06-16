{{-- Submitted Form --}}
<div id="submitted-form" class="d-none">
    {{-- Print Button --}}
    <div class="col-12 col-md-4 offset-md-4 mt-5 mb-3">
        <button id="print-btn" class="btn btn-warning btn-block" onclick="printAdmission()">
            <i class="fas fa-print"></i>
            Print Admission Form
        </button>
    </div>

    <div id="printContents" class="p-md-5 p-3 border">
        {{-- Letter Head --}}
        <div class="row border-bottom py-3">
            <div class="col-12 col-md-1 print-col-2">
                <img src="{{ asset('admin/img/MLG_Logo-Since-1999.jpg') }}" alt="MLG Logo" class="img-responsive" width="100%" id="print-logo">
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
            <div class="col-12 col-md-3 mb-3">
                <div class="thumbnail">
                    <img src="{{ asset('admin/img/empty-profile-img.png') }}" alt="Applicant Image" id="print-applicant-img" class="img-responsive" width="100%">
                    <div class="caption">
                        <p class="bg-danger text-white py-2 text-center">Applicant's Selfie</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 print-col-8">
                <h5 class="border-bottom">Personal Information</h5>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Name:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-fullname">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Contact:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-contact">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Gender:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-gender">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Civil Status:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-civil-status">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Religion:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-religion">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 d-none d-md-block print-show">
                        Physical Address:
                    </div>
                    <div class="col-12 col-md-9 font-weight-bold" id="print-physical-address">
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-2 print-col-4 text-right">
                <h5 class="border-bottom">Course Details</h5>
                <div class="row">
                    <div class="col-12 font-weight-bold">
                        <h1 class="text-danger my-0 font-weight-bold" id="print-course"></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 font-weight-bold my-0" id="print-gender">
                        <h6 class="my-0" id="print-year-level"></h6>
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
                
            </div>
            <div class="col-12 col-md-3 font-weight-bold" id="print-parent-contact">
                
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
                
            </div>
            
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                School Graduated:
            </div>
            <div class="col-12 col-md-7 font-weight-bold" id="print-school-graduated">
                
            </div>
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                Year Graduated:
            </div>
            <div class="col-12 col-md-1 text-right font-weight-bold" id="print-year-graduated">
                
            </div>
            
            <div class="col-12 col-md-2 d-none d-md-block print-show">
                School Address:
            </div>
            <div class="col-12 col-md-10 font-weight-bold" id="print-school-address">
                
            </div>
        </div>
        <div class="row mt-3 py-3 border-bottom">    
            <div class="col-12 border-bottom">
                <h5>Uploaded Documents</h5>
            </div>
    
            <div class="col-12 col-md-4 my-2 text-center print-col-4 uploaded-doc" id="print-med-cert">
                <div class="thumbnail">
                    <a href="#">
                        <div class="caption">
                            <p class="bg-danger text-white py-2">Medical Certificate</p>
                        </div>
                    </a>
                </div>
            </div>
                    
            <div class="col-12 col-md-4 my-2 text-center print-col-4 uploaded-doc" id="print-gmc">
                <div class="thumbnail">
                    <a href="#">
                        <div class="caption">
                            <p class="bg-danger text-white py-2">Good Moral Character</p>
                        </div>
                    </a>
                </div>
            </div>
                    
            <div class="col-12 col-md-4 my-2 text-center print-col-4 uploaded-doc" id="print-sf9-front">
                <div class="thumbnail">
                    <a href="#">
                        <div class="caption">
                            <p class="bg-danger text-white py-2">Report Card [FRONT]</p>
                        </div>
                    </a>
                </div>
            </div>
                    
            <div class="col-12 col-md-4 my-2 text-center print-col-4 uploaded-doc" id="print-sf9-back">
                <div class="thumbnail">
                    <a href="#">
                        <div class="caption">
                            <p class="bg-danger text-white py-2">Report Card [BACK]</p>
                        </div>
                    </a>
                </div>
            </div>
                    
            <div class="col-12 col-md-4 my-2 text-center print-col-4 uploaded-doc" id="print-psa-bc">
                <div class="thumbnail">
                    <a href="#">
                        <div class="caption">
                            <p class="bg-danger text-white py-2">PSA Birth Certificate</p>
                        </div>
                    </a>
                </div>
            </div>
                    
            <div class="col-12 col-md-4 my-2 text-center print-col-4 uploaded-doc" id="print-hd">
                <div class="thumbnail">
                    <a href="#">
                        <div class="caption">
                            <p class="bg-danger text-white py-2">Honorable Dismissal</p>
                        </div>
                    </a>
                </div>
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

    <div id="fees" class="mt-3">
        <div class="alert alert-primary">
            <h4 class="my-0">Tuition and Other Fees</h4>
        </div>
        
        <div class="table-responsive">
            <table id="payments" class="table table-sm table-bordered table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center font-weight-bold">#</th>
                        <th>Fee</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Tuition Fee --}}
                    <tr>
                        <td class="text-center font-weight-bold">A</td>
                        <td colspan="2" class="font-weight-bold text-uppercase">Tuition Fee</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Laboratory</td>
                        <td class="text-right">₱500.00 per Unit</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Lecture</td>
                        <td class="text-right">₱400.00 per Unit</td>
                    </tr>
    
                    {{-- Miscellaneous Fees --}}
                    <tr>
                        <td class="text-center font-weight-bold">B</td>
                        <td colspan="2" class="font-weight-bold text-uppercase">Miscellaneous Fees</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Registration Fee</td>
                        <td class="text-right">₱500.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Library Fee</td>
                        <td class="text-right">₱300.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Laboratory Fee</td>
                        <td class="text-right">₱300.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Computer Fee</td>
                        <td class="text-right">₱500.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Guidance & Counseling Fee</td>
                        <td class="text-right">₱200.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Handbook Fee</td>
                        <td class="text-right">₱100.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Medical/Dental Fee</td>
                        <td class="text-right">₱200.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Athletic Fee</td>
                        <td class="text-right">₱200.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>School Publication Fee</td>
                        <td class="text-right">₱100.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>School Id Fee</td>
                        <td class="text-right">₱200.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="font-weight-bold text-right">Total</td>
                        <td class="font-weight-bold text-right">₱2600.00</td>
                    </tr>
    
                    {{-- Development Fees --}}
                    <tr>
                        <td class="text-center font-weight-bold">C</td>
                        <td colspan="2" class="font-weight-bold text-uppercase">Development Fees</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Leadership Training Fee</td>
                        <td class="text-right">₱100.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Student Partnership & Student Org Activities Fee</td>
                        <td class="text-right">₱200.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Spiritual, Social & Values Program Fee</td>
                        <td class="text-right">₱100.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Bridging/Remedial Program Fee</td>
                        <td class="text-right">₱200.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="font-weight-bold text-right">Total</td>
                        <td class="font-weight-bold text-right">₱600.00</td>
                    </tr>
                    
                    {{-- Other Fees --}}
                    <tr>
                        <td class="text-center font-weight-bold">D</td>
                        <td colspan="2" class="font-weight-bold text-uppercase">Other Fees</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>NSPT (CWTS) - <span class="px-3 badge badge-pill badge-warning">FIRST YEAR STUDENTS ONLY</span></td>
                        <td class="text-right">₱300.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="font-weight-bold text-right">Total</td>
                        <td class="font-weight-bold text-right">₱300.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>