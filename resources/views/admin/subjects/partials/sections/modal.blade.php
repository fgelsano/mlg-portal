<!-- Modal -->
<div class="modal fade" id="subjects-modal" tabindex="-1" role="dialog" aria-labelledby="subjectModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="subjectTitle"><i class="fas fa-book"></i> New Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="subjectForm">
            <div class="modal-body">
                <div id="alerts" class="d-none p-3 my-3">
                    <p class="font-weight-bold text-danger m-0" id="alert-title"></p>
                    <div id="alerts-message"></div>
                </div>
                  @csrf
                  <div class="form-group">
                    <input type="text" name="code" id="code" class="form-control" placeholder="Enter Subject Code">
                  </div>
                  <div class="form-group">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter Subject Description">
                  </div>
                  <div class="form-group">
                    <input type="text" name="url" id="url" class="form-control" placeholder="Enter Subject URL">
                  </div>
                  <div class="form-group">
                    <select name="category" id="category" class="form-control">
                    </select>
                  </div>
                  <div class="form-group">
                    <select name="schedule" id="schedule" class="form-control">
                    </select>
                  </div>
                  <div class="form-group">
                    <select name="instructor" id="instructor" class="form-control">
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <select name="subjectType" id="subject-type" class="form-control">
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <select name="academic-year" id="ay" class="form-control">
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <select name="sem" id="sem" class="form-control">
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <input type="text" name="units" id="units" class="form-control" placeholder="Units">
                      </div>
                    </div>
                  </div>
                  
                  <input type="hidden" name="_method" value="" id="formMethod">
                  <input type="hidden" name="action-button" value="save">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success px-5" id="subjectSave" data-action="Save">
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