<div class="tab-pane fade" id="password-reset" role="tabpanel" aria-labelledby="password-reset-tab">
    <div class="row my-5">
        <div class="col-12 col-md-4">
            <ul class="p-5">
                <li class="my-0 text-danger" id="char">At least 8 characters long</li>
                <li class="my-0 text-danger" id="caps">At least 1 Capital letter</li>
                <li class="my-0 text-danger" id="num">At least 1 Number</li>
                <li class="my-0 text-danger" id="spec">At least 1 Special character</li>
            </ul>
        </div>
		<div class="col-12 col-md-8 border-left pl-5">
            {{-- <label>Current Password</label>
                <input type="hidden" name="user-id" value="{{ $profile->id }}" id="userId">
                <div class="form-group pass_show" id="current-pass"> 
                    <div class="input-group">
                            <input type="password" value="" class="form-control" placeholder="Current Password" name="current-password" id="current-password"> 
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit" id="validatePassword">Validate</button>
                            </div>
                    </div>
                </div>  --}}
            <form action="" id="resetPassForm">
                <label>New Password</label>
                <div class="form-group pass_show"> 
                    <input type="password" value="" class="form-control" placeholder="New Password" name="password" id="password"> 
                </div> 
                <label>Confirm Password</label>
                <div class="form-group pass_show"> 
                    <input type="password" value="" class="form-control" placeholder="Confirm Password" name="password-confirmation" id="password-confirm"> 
                </div> 
                <input type="hidden" name="userId" value="{{ $profile->id }}">
                <button type="submit" class="btn btn-success btn-sm px-5 d-none" id="resetBtn"><i class="fas fa-save"></i> Save</button>
            </form>
		</div>  
	</div>
</div>
