<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Profile" aria-hidden="true" id="profile-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" data-id="">
                    @csrf
                    <input type="hidden" name="role" value="{{ Auth::user()->role }}">
                    {{-- Personal Information --}}
                    <div class="row py-3">
                        <div class="col-12 col-md-4 mb-3 mb-md-0" id="profile-pic-container">
                            <div class="form-group ">
                                <input type="file" class="dropify" id="profile-pic" name="profile-pic">
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col-12 form-group school-id-label mb-1">
                                    <input type="text" name="school-id" id="school-id" placeholder="School Id" class="form-control" onInput="this.className = 'form-control'">
                                </div>
                                <div class="col-12 form-group first-name-label mb-1">
                                    <input type="text" name="first-name" id="first-name" placeholder="First Name" class="form-control" onInput="this.className = 'form-control'">
                                </div>
                                <div class="col-12 form-group middle-name-label mb-1">
                                    <input type="text" name="middle-name" id="middle-name" placeholder="Middle Name" class="form-control" onInput="this.className = 'form-control'">
                                </div>
                                <div class="col-12 form-group last-name-label mb-1">
                                    <input type="text" name="last-name" id="last-name" placeholder="Last Name" class="form-control" onInput="this.className = 'form-control'">
                                </div>
                                <div class="col-12 col-md-3 form-group gender mb-1">
                                    <select name="gender" id="gender" class="form-control" onInput="this.className = 'form-control'">
                                        <option disabled selected value="0">Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 form-group civil-status mb-1">
                                    <select name="civil-status" id="civil-status" class="form-control" onInput="this.className = 'form-control'">
                                        <option disabled selected value="0">Civil Status</option>
                                        <option value="1">Single</option>
                                        <option value="2">Married</option>
                                        <option value="3">Widow</option>
                                        <option value="4">Widower</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-5 form-group contact-label mb-1">
                                    <input type="text" name="contact-number" id="contact_number" class="form-control" oninput="this.className = 'form-control'" placeholder="(09__)-___-____" data-slots="_">
                                </div>
                                <div class="col-12 form-group religion-label mb-1">
                                    <input type="text" name="religion" id="religion" placeholder="Religion" class="form-control" onInput="this.className = 'form-control'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-9 form-group" id="course">
                            
                        </div>
                        <div class="col-12 col-md-3 form-group" id="year-level">
                            
                        </div>
                    </div>
                    @if (Auth::user()->role == 3 || Auth::user()->role == 0 || Auth::user()->role == 1)
                        <div class="row">
                            <div class="col-12 mb-2 lrn-label">
                                <input type="number" name="lrn" id="lrn" placeholder="Learner's Reference Number (LRN)" class="form-control">
                            </div>
                        </div>
                    @endif
                    <div class="row my-3">
                        <div class="col-12 col-md-6 mb-2 purok-label">
                            <input type="text" name="purok" id="purok" placeholder="Purok" class="form-control" onInput="this.className = 'form-control'">
                        </div>
                        <div class="col-12 col-md-6 mb-2 sitio-label">
                            <input type="text" name="sitio" id="sitio" placeholder="Sitio" class="form-control" onInput="this.className = 'form-control'">
                        </div>
                        <div class="col-12 mb-2 barangay-label">
                            <input type="text" name="street-barangay" id="street-barangay" placeholder="Street / Barangay" class="form-control" onInput="this.className = 'form-control'">
                        </div>
                        <div class="col-12 mb-2 municipality-label">
                            <input type="text" name="municipality" id="municipality" placeholder="Municipality" class="form-control" onInput="this.className = 'form-control'">
                        </div>
                        <div class="col-12 col-md-6 mb-2 province-label">
                            <input type="text" name="province" id="province" placeholder="Province" class="form-control" onInput="this.className = 'form-control'">
                        </div>
                        <div class="col-12 col-md-4 mb-2 zipcode-label">
                            <input type="number" name="zip-code" id="zip-code" placeholder="Zip Code" class="form-control" onInput="this.className = 'form-control'" maxlength="4">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-md-9 mb-2 school-graduated-label">
                            <input type="text" name="school-graduated" id="school-graduated" placeholder="School Graduated (Complete School Name)" class="form-control">
                        </div>
                        <div class="col-12 col-md-3 mb-2 year-graduated-label">
                            <input type="number" name="year-graduated" id="year-graduated" placeholder="Year Grad (e.g. 2019)" class="form-control" maxlength="4">
                        </div>
                        <div class="col-12 mb-2 school-address-label">
                            <textarea name="school-address" id="school-address" cols="30" rows="2" class="form-control" placeholder="School Address"></textarea>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-md-9 form-group emergency-contact-label">
                            <input type="text" name="emergency-contact-name" id="emergency-contact-name" class="form-control" placeholder="Parent / Guardian Name">
                        </div>
                        <div class="col-12 col-md-3 form-group contact-label">
                            <input type="text" name="emergency-contact-number" id="emergency-contact-number" class="form-control" placeholder="(09__)-___-____" data-slots="_">
                        </div>
                    </div>
                    @if (Auth::user()->role == 3 || Auth::user()->role == 0 || Auth::user()->role == 1)
                        <div class="row">
                            <div class="col-12 col-md-4 form-group ">
                                <input type="file" class="dropify" id="med-cert" name="med-cert">
                                <p class="text-center mb-0 bg-danger text-white py-2">Upload Medical Certificate</p>
                            </div>
                            <div class="col-12 col-md-4  form-group ">
                                <input type="file" class="dropify" id="gmc" name="gmc">
                                <p class="text-center mb-0 bg-danger text-white py-2">Upload Good Moral Character</p>
                            </div>
                            <div class="col-12 col-md-4  form-group ">
                                <input type="file" class="dropify" id="psa-bc" name="psa-bc">
                                <p class="text-center mb-0 bg-danger text-white py-2">Upload PSA Birth Certificate</p>
                            </div>
                            <div class="col-12 col-md-4  form-group ">
                                <input type="file" class="dropify" id="sf9-f" name="sf9-front">
                                <p class="text-center mb-0 bg-danger text-white py-2">Upload Report Card [FRONT]</p>
                            </div>
                            <div class="col-12 col-md-4  form-group ">
                                <input type="file" class="dropify" id="sf9-b" name="sf9-back">
                                <p class="text-center mb-0 bg-danger text-white py-2">Upload Report Card [BACK]</p>
                            </div>
                            <div class="col-12 col-md-4  form-group ">
                                <input type="file" class="dropify" id="hon-d" name="hd">
                                <p class="text-center mb-0 bg-danger text-white py-2">Upload Honorable Dismissal</p>
                            </div>
                        </div>
                    @endif
                    
            
                    <div class="row border-top">
                        <div class="col-12 col-md-3 offset-md-9 my-3">
                            <button type="submit" class="btn btn-primary px-3 btn-class btn-block" id="updateProfileBtn">
                                <i class="fas fa-save"></i>
                                Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>