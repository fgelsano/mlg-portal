<!-- Modal -->
<div class="modal fade" id="instructor-modal" tabindex="-1" role="dialog" aria-labelledby="instructorModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="instructorTitle"><i class="fas fa-chalkboard-teacher"></i> New Instructor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="instructorForm">
            <div class="modal-body">
                <div id="alerts" class="d-none p-3 my-3">
                    <p class="font-weight-bold text-danger m-0" id="alert-title"></p>
                    <div id="alerts-message"></div>
                </div>
                
                    @csrf
                    <div class="form-group">
                        <input type="text" name="instructor-id" id="instructor-id" class="form-control" placeholder="Enter Instructor Id" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last-name" id="last-name" class="form-control" placeholder="Enter Instructor Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="first-name" id="first-name" class="form-control" placeholder="Enter Instructor First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Instructor Email Address" required>
                    </div>
                    <div class="form-group">
                        <select name="status" id="status" class="form-control" required>
                            <option selected disabled>Select Status</option>
                            <option value="4">Full Time</option>
                            <option value="5">Part Time</option>
                        </select>
                    </div>
                    <input type="hidden" name="_method" value="" id="formMethod">
                    <input type="hidden" name="action-button" value="save">
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success px-3" id="instructorSave" data-action="Save">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn btn-danger px-3" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>