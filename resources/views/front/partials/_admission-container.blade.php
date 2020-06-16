{{-- Admission Form --}}
<div class="d-none mt-5" id="admission">
    <form action="" method="POST" id="admission-form" enctype="multipart/form-data" class="multisteps-form__form">
        @csrf
        <input type="hidden" name="studentType" id="student-type">
        <input type="hidden" name="profileId" id="profile-id">
        <div class="container">

            <div class="multisteps-form">

                <!--progress bar-->
                <div class="row">
                    <div class="col-12 col-lg-10 ml-auto mr-auto mb-4">
                        <div class="multisteps-form__progress">
                        <button class="multisteps-form__progress-btn js-active" type="button" title="Personal Info">Personal Information</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Physical Address">Physical Address</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Emergency Contact">Emergency Contact</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Educational History">Educational History</button>
                        <button class="multisteps-form__progress-btn" type="button" title="LRN">Learner's Reference Number</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Course">Course Information</button>
                        <button class="multisteps-form__progress-btn" type="button" title="File Uploads">Documents File Uploads</button>
                        </div>
                    </div>
                </div>

                <!--form panels-->
                <div class="row">
                  <div class="col-12 col-md-10 m-auto">

                        <!--Personal Info Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                            <h3 class="multisteps-form__title mb-3">Personal Information</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._personal-information')
                                
                            <div class="button-row d-flex mt-4">
                                <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next">Next</button>
                            </div>
                            </div>
                        </div>

                        <!--Physical Address Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title mb-3">Physical Address</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._physical-address')
        
                            <div class="button-row d-flex mt-4">
                                <button class="btn btn-primary js-btn-prev px-5" type="button" title="Prev">Prev</button>
                                <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next">Next</button>
                            </div>
                            </div>
                        </div>

                        <!--Emergency Contact Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title mb-3">Emergency Contact</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._emergency-contact')
                            
                            <div class="button-row d-flex mt-4 col-12">
                                <button class="btn btn-primary js-btn-prev px-5" type="button" title="Prev">Prev</button>
                                <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next">Next</button>
                            </div>
                            
                            </div>
                        </div>

                        <!--Educational History Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title mb-3">Educational History</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._educational-history')
                                
                            <div class="button-row d-flex mt-4">
                                <button class="btn btn-primary js-btn-prev px-5" type="button" title="Prev">Prev</button>
                                <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next">Next</button>
                            </div>
                            </div>
                        </div>
    
                        <!--LRN Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title mb-3">Learner's Reference Number</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._lrn')
                                
                            <div class="button-row d-flex mt-4">
                                <button class="btn btn-primary js-btn-prev px-5" type="button" title="Prev">Prev</button>
                                <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next">Next</button>
                            </div>
                            </div>
                        </div>
    
                        <!--Course Information Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title mb-3">Course Information</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._course-details')
                                
                            <div class="button-row d-flex mt-4">
                                <button class="btn btn-primary js-btn-prev px-5" type="button" title="Prev">Prev</button>
                                <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next">Next</button>
                            </div>
                            </div>
                        </div>
    
                        <!--Documents File Uploads Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="multisteps-form__title mb-3">Documents File Uploads</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._file-uploads')
                                
                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev mr-auto px-5" type="button" title="Prev">Prev</button>
                                    <button type="submit" class="btn btn-success btn-sm my-0 px-5" id="submitAdmissionBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    
                   </div>
                </div>
              </div>
        </div>
    </form>
</div>