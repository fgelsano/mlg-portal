<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Payment" aria-hidden="true" id="billing-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Billing for <span id="applicant-student"></span> (<span class="text-danger" id="student-id"></span>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="billingForm">
                <div class="modal-body px-3">
                    <p class="mb-0">Name: <strong><span id="student-name"></span></strong></p>
                    <p class="mt-0">Course: <strong><span id="course-code"></span> (<span id="year-level"></span>)</strong></p>
                    <div id="fees-list" class="mt-3 border-top">
                        <p class="alert alert-primary py-0 font-weight-bold my-1">A. Tuition Fees</p>
                        <div id="tuition-fees"></div>
                        <p class="alert alert-primary py-0 font-weight-bold my-1">B. Miscellaneous Fees</p>
                        <div id="miscellaneous-fees"></div>
                        <p class="alert alert-primary py-0 font-weight-bold my-1">C. Development Fees</p>
                        <div id="development-fees"></div>
                        <p class="alert alert-primary py-0 font-weight-bold my-1">D. Other Fees</p>
                        <div id="other-fees"></div>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-success btn-sm px-5" id="updateBilling" data-id="" data-action="Save">
                        <i class="fas fa-cash-register mr-2"></i> Update Billing
                    </button>
                    <button type="button" class="btn btn-danger btn-sm px-5" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </button>
                    @csrf
                </div>
            </form>
        </div>
    </div>
</div>