<!-- Modal -->
<div class="modal fade" id="add-billing-modal" data-id="{{ $profile->id }}" tabindex="-1" role="dialog" aria-labelledby="AddBillingModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-invoice-dollar"></i> Add Bill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div id="alerts" class="d-none p-3 my-3">
                    <p class="font-weight-bold text-danger m-0" id="alert-title"></p>
                    <div id="alerts-message"></div>
                </div>
                <form action="" id="add-bill-form">
                    {{-- @csrf --}}
                    <div class="row border-bottom mb-3 pb-3">
                        <div class="col-md-4 col-12">
                            <div class="col-12 px-0">
                                <label for="" class="mb-0 small font-weight-bold">Academic Year</label>
                            </div>
                            <div class="col-12 px-0">
                                <select name="ay" id="ay" class="form-control form-control-sm">
                                    <option value="" selected disabled>Select AY</option>
                                    <option value="20-21">20-21</option>
                                    <option value="21-22">21-22</option>
                                    <option value="22-23">22-23</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 col-12 px-0">
                            <label for="" class="mb-0 small font-weight-bold">Semester</label>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="custom-control custom-radio custom-control-inline mr-0">
                                        <input type="radio" value="1" id="1sem" name="sem" class="custom-control-input">
                                        <label class="custom-control-label" for="1sem">1st Sem</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="custom-control custom-radio custom-control-inline mr-0">
                                        <input type="radio" value="2" id="2sem" name="sem" class="custom-control-input">
                                        <label class="custom-control-label" for="2sem">2nd Sem</label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="custom-control custom-radio custom-control-inline mr-0">
                                        <input type="radio" value="3" id="3sem" name="sem" class="custom-control-input">
                                        <label class="custom-control-label" for="3sem">Summer</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">Tuition Fee:</div>
                        <div class="col-md-6 col-12">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="peso-symbol">₱</span>
                                </div>
                                <input type="text" id="input-tuition-fee" name="tuition-fee" class="form-control" placeholder="00.00" aria-label="Tuition Fee" aria-describedby="Tuition Fee">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">Miscellaneous Fee:</div>
                        <div class="col-md-6 col-12">
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="peso-symbol">₱</span>
                                </div>
                                <input type="text" id="input-misc-fee" name="miscellaneous-fee" class="form-control" placeholder="00.00" aria-label="Miscellaneous Fee" aria-describedby="Miscellaneous Fee">
                            </div>
                        </div>
                    </div>

                    <div class="row font-weight-bold">
                        <div class="col-md-6 col-12">Total</div>
                        <div class="col-md-6 col-12 text-right font-20" id="view-total-fees">0</div>
                    </div>

                    <input type="hidden" name="total-fees" id="total-fees" value="0">
                
                    <p class="text-danger border-bottom my-3 font-weight-bold"><i>Less:</i></p>
                    
                    <div id="new-deduction-inputs"></div>

                    <div class="row font-weight-bold">
                        <div class="col-md-6 col-12">Total Deductions</div>
                        <div class="col-md-6 col-12 text-right font-20" id="view-total-deduction">₱ 00.00</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <button class="btn-success btn-block btn-sm" id="btn-new-deduction"><i class="fas fa-receipt mr-2"></i> New Deduction</button>
                        </div>
                    </div>
                    <input type="hidden" name="total-deductions" id="total-deductions">
                
                    <div class="row font-weight-bold mt-3">
                        <div class="col-md-6 col-12 text-uppercase">
                            Total Balance<br>
                            <span id="balance-type" class="badge px-2"></span>
                        </div>
                        <div class="col-md-6 col-12 text-right font-30" id="total-balance">₱ 00.00</div>
                    </div>
                    <input type="hidden" name="_method" value="" id="formMethod">
                    <input type="hidden" name="action-button" value="save">
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success px-3" id="addBillSave" data-action="Save">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn btn-danger px-3" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>