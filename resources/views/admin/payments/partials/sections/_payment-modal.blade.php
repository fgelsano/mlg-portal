<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Payment" aria-hidden="true" id="payment-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment for <span id="applicant-student"></span> #<span class="text-danger" id="student-id">20-000001</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="paymentForm">
                <div class="modal-body px-3">
                    <p class="mb-0">Name: <strong><span id="student-name">Student Name</span></strong></p>
                    <p class="mt-0">Course: <strong><span id="course-code">Course Code</span> (<span id="year-level">(First Year)</span>)</strong></p>
                    <div class="form-group">
                        <label class="mb-0" for="type">Payment Type</label>
                        <input type="text" name="payment_type" id="type" class="form-control" value="Enrollment Fee">
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label class="mb-0" for="balance">Balance</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" name="balance" id="balance" disabled>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label class="mb-0" for="amount">Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" name="amount" id="amount">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label class="mb-0" for="or_number">O.R. Number</label>
                            <input type="text" name="or_number" id="or_number" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label class="mb-0" for="ref_number">Reference Number</label>
                            <input type="text" name="ref_number" id="ref_number" class="form-control" placeholder="'None' if paid at the Cashier">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-0" for="comments">Comments</label>
                        <textarea name="comments" id="comments" cols="30" rows="5" class="form-control" placeholder="(e.g. 'TES Refund', etc)"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-success btn-sm px-5" id="acceptPayment" data-id="" data-action="Save">
                        <i class="fas fa-cash-register mr-2"></i> Accept Payment
                    </button>
                    <button type="button" class="btn btn-danger btn-sm px-5" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </button>
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="payment_id" id="payment-id">
                    <input type="hidden" name="previousBalance" id="previous-balance">
                </div>
            </form>
        </div>
    </div>
</div>