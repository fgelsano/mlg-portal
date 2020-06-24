<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Payment" aria-hidden="true" id="editSubject-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-book mr-3"></i>Edit Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editSubjectForm" data-id="">
                <div class="modal-body px-3">
                    <p class="small m-0 border-bottom">Code</p>
                    <h4 id="code"></h4>
                    <p class="small m-0 border-bottom">Description</p>
                    <h4 id="description"></h4>
                    <p class="small m-0 border-bottom">Schedule</p>
                    <h4 id="schedule" class="mb-3"></h4>
                    <p class="small m-0 border-bottom">LMS Link</p>
                    <div class="form-group">
                        <input type="text" name="url" id="subject-link" class="form-control" placeholder="LMS Link">
                    </div>
                    <p class="small m-0 border-bottom">Status</p>
                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="0" selected disabled>Set Status</option>
                            <option value="1">Assigned</option>
                            <option value="3">Not Yet Ready</option>
                            <option value="4">Ready</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer text-left">
                    <button type="submit" class="btn btn-success btn-sm px-5" id="updateSubject">
                        <i class="fas fa-save mr-2"></i> Save
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