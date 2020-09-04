<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Admission" aria-hidden="true" id="viewStudent-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-3">
            <div class="modal-header">
                <h5 class="modal-title text-danger"><span id="requested-by"></span>'s Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3">
                <div class="row">
                    {{-- Personal Information --}}
                    <div class="col-12 col-md-4 mb-3" id="profile-pic">
                        {{-- <img src="{{ asset('admin/img/empty-profile-img.png') }}" alt="Applicant Image" id="applicant-img" class="img-responsive" width="100%"> --}}
                        <div class="thumbnail">
                            <a href="#" class="caption-link" data-img="" id="profile-pic-link">
                                <div class="caption">
                                    <p class="bg-danger text-white py-2 text-center">Applicant's Selfie</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
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
                        <div class="row">
                            <div class="col-12 col-md-3 d-none d-md-block">
                                Course:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold my-0" id="gender">
                                <span id="course"></span> (<span id="year-level"></span>)
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 border-bottom">
                                <h5>Emergency Contacts</h5>
                            </div>
                            <div class="col-12 col-md-3 d-none d-md-block ">
                                Name:
                            </div>
                            <div class="col-12 col-md-9 font-weight-bold">
                                <span id="parent-name"></span> [<span id="parent-contact"></span>]
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
                    </div>
                </div>                
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