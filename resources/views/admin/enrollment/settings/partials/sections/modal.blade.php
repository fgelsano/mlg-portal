<!-- Modal -->
<div class="modal fade" id="options-modal" tabindex="-1" role="dialog" aria-labelledby="optionModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="optionTitle"><i class="fas fa-list"></i> New Option</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="optionForm">
            <div class="modal-body">
                <div id="alerts" class="d-none p-3 my-3">
                    <p class="font-weight-bold text-danger m-0" id="alert-title"></p>
                    <div id="alerts-message"></div>
                </div>
                    @csrf
                    
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Option">
                    </div>
                    <div class="alert alert-info">
                        <p class="font-weight-bold mb-0">Option Types</p>
                        <ul class="my-0">
                            <li>
                                <div class="row">
                                    <div class="col-6">
                                        Subject Category
                                    </div>
                                    <div class="col-6">
                                        Type "subject-category"
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-6">
                                        Room
                                    </div>
                                    <div class="col-6">
                                        Type "room"
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-6">
                                        Laboratory
                                    </div>
                                    <div class="col-6">
                                        Type "lab"
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-6">
                                        Academic Year
                                    </div>
                                    <div class="col-6">
                                        Type "ay"
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <p class="mt-3 small lead">For new type of option, make sure to specify a new option type.</p>
                    </div>
                    <div class="form-group">
                        <input type="text" name="type" id="type" class="form-control" placeholder="Enter Option Type">
                    </div>
                    <div class="form-group">
                        <input type="text" name="extra" id="extra" class="form-control" placeholder="Extra (Optional)">
                    </div>
                    
                    <input type="hidden" name="_method" value="" id="formMethod">
                    <input type="hidden" name="action-button" value="save">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success px-3" id="optionSave" data-action="Save">
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