<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Admission" aria-hidden="true" id="admission-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-3">
            <div class="modal-header">
                <h5 class="modal-title">Admission Request by <span class="text-danger" id="requested-by">Francis Gelsano</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3">
                <div class="row">
                    {{-- Personal Information --}}
                    <div class="col-12 col-md-8 print-col-8">
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block print-show">
                                Name:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="fullname">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block print-show">
                                Gender:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="gender">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block print-show">
                                Civil Status:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="civil-status">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block print-show">
                                Religion:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="religion">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block print-show">
                                Address:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="physical-address">
                                
                            </div>
                        </div>
                    </div>
                    {{-- Course Details --}}
                    <div class="col-12 col-md-4 text-md-right mt-3 text-center mt-sm-3 print-col-4">
                        <h5>Course Details</h5>
                        <h1 class="text-danger my-0 font-weight-bold" id="course"></h1>
                        <h6 class="my-0" id="year-level"></h6>
                        <div class="mt-4">
                            <h2 class="text-danger" id="request-id"></h2>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 border-bottom">
                        <h5>Emergency Contacts</h5>
                    </div>
                    <div class="col-12 col-md-2 d-none d-md-block print-show">
                        Name:
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold" id="contact-name">
                        
                    </div>
                    <div class="col-12 col-md-3 font-weight-bold" id="contact-number">
                        
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 border-bottom">
                        <h5>Educational History</h5>
                    </div>
                    <div class="col-12 col-md-8 font-weight-bold" id="school">
                        
                    </div>
                    <div class="col-12 col-md-1 text-right d-none d-md-block print-show">
                        Year:
                    </div>
                    <div class="col-12 col-md-3 font-weight-bold" id="year">
                        
                    </div>
                    <div class="col-12 col-md-8 font-weight-bold" id="school-address">
                        
                    </div>
                    <div class="col-12 col-md-1 text-right d-none d-md-block print-show">
                        LRN:
                    </div>
                    <div class="col-12 col-md-3 font-weight-bold text-danger" id="lrn">
                        
                    </div>
                </div>
                <div class="row mt-3 py-3">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 border-bottom">
                                <h5>Uploaded Documents</h5>
                            </div>
                        </div>
                        <div class="row my-2 hover-shadow" id="med-cert-popover" data-toggle="popover" data-placement="right" data-trigger="focus" tabindex="0" data-html=true title="Medical Certificate" data-content="<p>No File Uploaded</p>">
                            <div class="col-2 col-md-2 text-center print-col-1" id="med-cert">
                                
                            </div>
                            <div class="col-10 col-md-10 print-col-11">
                                Medical Certificate
                            </div>
                        </div>
                        <div class="row my-2 hover-shadow" id="gmc-popover" data-toggle="popover" data-trigger="focus" tabindex="1" data-html=true title="Good Moral Character" data-content="<p>No File Uploaded</p>">
                            <div class="col-2 col-md-2 text-center print-col-1" id="gmc">
                                
                            </div>
                            <div class="col-10 col-md-10 print-col-11">
                                Good Moral Character
                            </div>
                        </div>
                        <div class="row my-2 hover-shadow" id="sf9-front-popover" data-toggle="popover" data-trigger="focus" tabindex="2" data-html=true title="SF9/Form 138 (Front)" data-content="<p>No File Uploaded</p>">
                            <div class="col-2 col-md-2 text-center print-col-1" id="sf9-front">
                                
                            </div>
                            <div class="col-10 col-md-10 print-col-11">
                                SF9 or Form 138 [FRONT VIEW]
                            </div>
                        </div>
                        <div class="row my-2 hover-shadow" id="sf9-back-popover" data-toggle="popover" data-trigger="focus" tabindex="3" data-html=true title="SF9/Form 138 (Back)" data-content="<p>No File Uploaded</p>">
                            <div class="col-2 col-md-2 text-center print-col-1" id="sf9-back">
                                
                            </div>
                            <div class="col-10 col-md-10 print-col-11">
                                SF9 or Form 138 [BACK VIEW]
                            </div>
                        </div>
                        <div class="row my-2 hover-shadow" id="gwa-popover" data-toggle="popover" data-trigger="focus" tabindex="4" data-html=true title="General Weighted Average" data-content="<p>No File Uploaded</p>">
                            <div class="col-2 col-md-2 text-center print-col-1" id="gwa">
                                
                            </div>
                            <div class="col-10 col-md-10 print-col-11">
                                GWA Certification
                            </div>
                        </div>
                        <div class="row my-2 hover-shadow" id="psa-bc-popover" data-toggle="popover" data-trigger="focus" tabindex="5" data-html=true title="PSA Birth Certificate (NSO)" data-content="<p>No File Uploaded</p>">
                            <div class="col-2 col-md-2 text-center print-col-1" id="psa-bc">
                                
                            </div>
                            <div class="col-10 col-md-10 print-col-11">
                                PSA Birth Certificate [NSO]
                            </div>
                        </div>
                        <div class="row my-2 hover-shadow" id="hd-popover" data-toggle="popover" data-trigger="focus" tabindex="6" data-html=true title="Honorable Dismissal" data-content="<p>No File Uploaded</p>">
                            <div class="col-2 col-md-2 text-center print-col-1" id="hd">
                                
                            </div>
                            <div class="col-10 col-md-10 print-col-11">
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
                        <img src="{{ asset('/files/storage//empty-profile-img.png') }}" alt="Applicant Image" id="applicant-img" class="img-responsive" width="100%">
                    </div>
                </div>
            </div>
            <div class="modal-footer text-left">
                <form action="" id="acceptForm">
                    <button type="button" class="btn btn-success btn-sm px-5" id="enrollAdmission" data-id="">
                        <i class="fas fa-user-check mr-2"></i> Accept
                    </button>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="requestType" value="markAccept">
                </form>
                <button type="button" class="btn btn-danger btn-sm px-5" data-dismiss="modal" id="rejectAdmission" data-id="">
                    <i class="fas fa-user-times mr-2"></i> Reject
                </button>
            </div>
        </div>
    </div>
</div>