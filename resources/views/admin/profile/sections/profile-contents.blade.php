<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="row mt-5">
        {{-- Personal Information --}}
        <div class="col-12 col-md-3 mb-3">
            <div class="thumbnail">
                <img src="{{ asset('admin/img/empty-profile-img.png') }}" alt="Applicant Image" id="print-applicant-img" class="img-responsive" width="100%">
                <div class="caption">
                    <p class="bg-danger text-white py-2 text-center">Profile Picture</p>
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
    <div class="row mt-3 py-3">    
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
</div>