<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Admission" aria-hidden="true" id="enrol-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enrolling <span class="text-danger" id="enrollee-name">Francis Gelsano</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="enrollForm">
                <div class="modal-body px-3">
                    <div class="row border-bottom">
                        {{-- Personal Information --}}
                        <div class="col-12 col-md-8 print-col-8">
                            <div class="row">
                                <div class="col-12 col-md-3 d-none d-md-block print-show">
                                    Name:
                                </div>
                                <div class="col-12 col-md-9 font-weight-bold" id="enrollee-fullname">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 d-none d-md-block print-show">
                                    Gender:
                                </div>
                                <div class="col-12 col-md-9 font-weight-bold" id="enrollee-gender">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 d-none d-md-block print-show">
                                    Civil Status:
                                </div>
                                <div class="col-12 col-md-9 font-weight-bold" id="enrollee-civil-status">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 d-none d-md-block print-show">
                                    Religion:
                                </div>
                                <div class="col-12 col-md-9 font-weight-bold" id="enrollee-religion">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 d-none d-md-block print-show">
                                    Address:
                                </div>
                                <div class="col-12 col-md-9 font-weight-bold" id="enrollee-physical-address">
                                    
                                </div>
                            </div>
                        </div>
                        {{-- Course Details --}}
                        <div class="col-12 col-md-4 text-md-right text-center print-col-4">
                            <h5>Course Details</h5>
                            <h1 class="text-danger my-0 font-weight-bold" id="enrollee-course"></h1>
                            <h6 class="my-0" id="enrollee-year-level"></h6>
                            <div class="mt-1">
                                <h2 class="text-danger" id="enrollee-request-id"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4 class="bg-success text-center text-white py-1">Enrolled Subjects</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-compress">
                                    <thead>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Schedule</th>
                                        <th>Instructor</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="enrolled-subjects" data-empty='0'>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-3 datatables-container">
                            @include('admin.enrollment.enroll-partials.sections.table')
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-success btn-sm px-5" id="confirmedEnroll" data-id="" data-action="Save">
                        <i class="fas fa-user-check mr-2"></i> Finish Enrollment
                    </button>
                    <button type="button" class="btn btn-danger btn-sm px-5" data-dismiss="modal">
                        <i class="fas fa-user-times mr-2"></i> Cancel
                    </button>
                    @csrf
                    <input type="hidden" name="_method" value="">
                    <input type="hidden" name="applicant_id" id="applicant-id">
                </div>
            </form>
        </div>
    </div>
</div>