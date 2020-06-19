
<!-- Modal -->
<div class="modal fade" id="users-modal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="userTitle"><i class="fas fa-book"></i> New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="" id="userForm">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="user-name" id="user-name" class="form-control" placeholder="Full Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" name="user-email" id="user-email" placeholder="Email Address" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="user-password" id="user-password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="user-confirm-password" id="user-confirm-password" placeholder="Confirm Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="user-role" id="user-role" class="form-control"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success px-5" id="userSave" data-action="Save">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn btn-danger px-5" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                </div>          
            </form>
        </div>
    </div>
</div>