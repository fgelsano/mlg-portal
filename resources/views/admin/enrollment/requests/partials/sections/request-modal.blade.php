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
                    <div class="col-12 col-md-3 mb-3" id="profile-pic">
                        {{-- <img src="{{ asset('admin/img/empty-profile-img.png') }}" alt="Applicant Image" id="applicant-img" class="img-responsive" width="100%"> --}}
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-image="" id="profile-pic-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2 text-center">Applicant's Selfie</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h5 class="border-bottom">Personal Information</h5>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block">
                                School Id:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold text-danger" id="schoolId">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block">
                                Name:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="fullname">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block">
                                Contact:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="contact">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block ">
                                Gender:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="gender">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block ">
                                Civil Status:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="civil-status">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block ">
                                Religion:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="religion">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block ">
                                Address:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold" id="physical-address">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 text-right">
                        <h5 class="border-bottom">Course</h5>
                        <div class="row">
                            <div class="col-12 font-weight-bold">
                                <h1 class="text-danger my-0 font-weight-bold" id="course"></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 font-weight-bold my-0" id="gender">
                                <h6 class="my-0" id="year-level"></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 border-bottom">
                        <h5>Emergency Contacts</h5>
                    </div>
                    <div class="col-12 col-md-2 d-none d-md-block ">
                        Name:
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold" id="parent-name">
                        
                    </div>
                    <div class="col-12 col-md-3 font-weight-bold" id="parent-contact">
                        
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 border-bottom">
                        <h5>Educational History</h5>
                    </div>
                    <div class="col-12 col-md-2 d-none d-md-block ">
                        LRN:
                    </div>
                    <div class="col-12 col-md-10 font-weight-bold text-danger" id="lrn">
                        
                    </div>
                    
                    <div class="col-12 col-md-2 d-none d-md-block ">
                        School:
                    </div>
                    <div class="col-12 col-md-10 font-weight-bold" id="school-graduated">
                        
                    </div>                    
                    <div class="col-12 col-md-2 d-none d-md-block ">
                        Address:
                    </div>
                    <div class="col-12 col-md-10 font-weight-bold" id="school-address">
                        
                    </div>
                </div>
                <div class="row mt-3 py-3 border-bottom">    
                    <div class="col-12 border-bottom">
                        <h5>Uploaded Documents</h5>
                    </div>
            
                    <div class="col-12 col-md-4 my-2 text-center uploaded-doc" id="med-cert">
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-image="" id="med-cert-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2">Medical Certificate</p>
                                </div>
                            </a>
                        </div>
                    </div>
                            
                    <div class="col-12 col-md-4 my-2 text-center uploaded-doc" id="gmc">
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-image="" id="gmc-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2">Good Moral Character</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4 my-2 text-center uploaded-doc" id="psa-bc">
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-image="" id="psa-bc-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2">PSA Birth Certificate</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 my-2 text-center  uploaded-doc" id="sf9-front">
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-image="" id="sf9-front-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2">Report Card [FRONT]</p>
                                </div>
                            </a>
                        </div>
                    </div>
                            
                    <div class="col-12 col-md-4 my-2 text-center uploaded-doc" id="sf9-back">
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-image="" id="sf9-back-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2">Report Card [BACK]</p>
                                </div>
                            </a>
                        </div>
                    </div>
                            
                    <div class="col-12 col-md-4 my-2 text-center uploaded-doc" id="hd">
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-image="" id="hd-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2">Honorable Dismissal</p>
                                </div>
                            </a>
                        </div>
                    </div>
                        
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <h1 class="text-danger font-weight-bold" id="admission-status"></h1>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Uploaded Document" aria-hidden="true" id="document-viewer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-3">
            <div class="modal-header">
                <h5 class="modal-title" id="document-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3">
                <img src="" class="img-responsive" width="100%" id="document-img">
            </div>
        </div>
    </div>
</div>