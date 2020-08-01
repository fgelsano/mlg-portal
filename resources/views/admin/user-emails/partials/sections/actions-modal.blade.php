<!-- Modal -->
<div class="modal fade" id="user-email-modal" tabindex="-1" role="dialog" aria-labelledby="userEmail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-book"></i> <span id="modal-action"></span> User Email for <span id="userEmailTitle"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="" id="userEmailForm" data-id="">
                <div class="modal-body">
                    @csrf
                    <p class="my-0">Name: <span id="user-name" class="text-primary font-weight-bold"></span></p>
                    <p class="my-0">Role: <span id="user-role" class="text-primary font-weight-bold"></span></p>
                    <div class="form-group mt-3">
                        <input type="text" name="suggested_email" id="suggested_email" class="form-control" placeholder="Suggested Email">
                    </div>
                    <div class="form-group">
                        <input type="text" name="created_email" id="created_email" class="form-control" placeholder="Created Email">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email_password" id="email_password" class="form-control" placeholder="Email Password">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lms_password" id="lms_password" class="form-control" placeholder="LMS Password">
                    </div>
                    <input type="hidden" name="user_id" value="" id="user_id">
                    <input type="hidden" name="_method" value="" id="formMethod">
                    <input type="hidden" name="action-button" value="save">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success px-5" id="saveUserEmail" data-action="Save">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn btn-sm btn-danger px-5" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                </div>          
            </form>
        </div>
    </div>
</div>