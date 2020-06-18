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
                        <button class="multisteps-form__progress-btn" type="button" title="File Uploads" id="file-upload-btn">Documents File Uploads</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Data Privacy Agreement" id="dpa-agreement">Data Privacy Agreement</button>
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
                            
                                <div class="button-row d-flex mt-4">
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
                                    <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next" id="course-details-next-btn">Next</button>
                                </div>
                            </div>
                        </div>
    
                        <!--Documents File Uploads Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn" id="file-uploads-panel">
                            <h3 class="multisteps-form__title mb-3">Documents File Uploads</h3>
                            <div class="multisteps-form__content">
                            
                                @include('front.partials._file-uploads')
                                
                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary js-btn-prev mr-auto px-5" type="button" title="Prev">Prev</button>
                                    <button class="btn btn-primary ml-auto js-btn-next px-5" type="button" title="Next" id="course-details-next-btn">Next</button>
                                </div>
                            </div>
                        </div>

                        <!--Data Privacy Agreement Panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn" id="file-uploads-panel">
                            <h3 class="multisteps-form__title mb-3 text-center">Data Privacy Agreement</h3>
                            <div class="multisteps-form__content text-center">
                                <div class="row px-5" id="data-privacy-agreement-panel">
                                    <div class="col-12 alert alert-primary p-5">
                                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                            <li class="nav-item">
                                            <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english" role="tab" aria-controls="home" aria-selected="true">English</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link" id="tagalog-tab" data-toggle="tab" href="#tagalog" role="tab" aria-controls="profile" aria-selected="false">Tagalog</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link" id="cebuano-tab" data-toggle="tab" href="#cebuano" role="tab" aria-controls="contact" aria-selected="false">Cebuano</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content py-3" id="myTabContent">
                                            <div class="tab-pane fade show active p-3" id="english" role="tabpanel" aria-labelledby="english-tab">
                                                I hereby certify that the information given are true and correct to the best of my knowledge and I allow MLG College of Learning, Inc to use my details to create and/or update his/her learner profile in their school portal. The information herein shall be treated as confidential in compliance with the Data Privacy Act of 2012.
                                            </div>
                                            <div class="tab-pane fade p-3" id="tagalog" role="tabpanel" aria-labelledby="tagalog-tab">
                                                Aking pinatutunayan na ang mga impormasyong akong ibinigay ay totoo at tama sa abot nga aking kaalaman at pinahihintulutan kung gamitin ng MLG College of Learning, Inc ang aking mga detalye upang sila ay makabuo o makapagwasto ng aking profile sa kanilang school portal. Ang mga impormasyon dito ay dapat ituring na compidensyal at naayon sa Data Privacy Act of 2012.
                                            </div>
                                            <div class="tab-pane fade p-3" id="cebuano" role="tabpanel" aria-labelledby="cebuano-tab">
                                                Akong gikumpirmar nga ang mga impormasyon nga akong gipangbutang tinuod ug sakto basi sa tibook nako nga nahibaluan ug akong gitugutan ang MLG College of Learning, Inc nga gamiton ang akong mga detalye para makahimo o makatul-id sa akong profile sa ilahang school portal. Ang mga impormasyon nga akong gihatag dapat nga tratuhon isip sekreto isip pagsunod sa lagda sa Data Privacy Act of 2012.
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <div class="col-12 col-md-2 offset-md-5 text-center">
                                                <p class="font-weight-bold"><input type="checkbox" name="dpa-agree" id="dpa-agree"> Yes, I Agree.</p>
                                            </div>
                                        </div>
                                        <p class="font-weight-bold mt-3 text-danger text-center" id="dpa-agree-date"></p>
                                        <input type="hidden" name="dpa-agreement-date" id="dpa-agreement-date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 offset-md-4">
                                        <button type="submit" class="btn btn-success btn-sm my-0 px-5 btn-block" id="submitAdmissionBtn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                   </div>
                </div>
              </div>
        </div>
    </form>
</div>