
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
            <form action="" id="userForm" data-id="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2 form-group ">
                            <input type="file" class="dropify" id="profile-pic" name="profile-pic" data-default-file="">
                            <p class="text-center mb-0 bg-danger text-white py-2">Profile Picture<br><small>Recommended Dimension: 200x200 pixels</small></p>
                        </div>           
                    </div>   
                    <div class="form-group">
                        <input type="text" name="first-name" id="first-name" class="form-control" placeholder="First Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="last-name" id="last-name" class="form-control" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" name="user-email" id="user-email" placeholder="Email Address" class="form-control" readonly="readonly" disabled>
                    </div>
                    <div class="form-group">
                        <select name="user-role" id="user-role" class="form-control">
                            <option disabled selected>User Role</option>
                            <option value="1">Registrar</option>
                            <option value="2">Cashier</option>
                            <option value="3">Student</option>
                            <option value="4">Full Time Instructor</option>
                            <option value="5">Part Time Instructor</option>
                            <option value="6">Parent</option>
                            <option value="7">School Administrator</option>
                        </select>
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