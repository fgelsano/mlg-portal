<div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <form id="editProfileForm" data-id="" data-course="" data-year-level="">
        @csrf
        {{-- Personal Information --}}
        <div class="row py-3">
            <div class="col-12 col-md-4 mb-3" id="profile-pic-container">
                <div class="form-group ">
                    <input type="file" class="dropify" id="profile-pic" name="profile-pic">
                </div>
                <div class="caption">
                    <p class="bg-danger text-white py-2 text-center">Upload Profile Picture</p>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 form-group first-name-label">
                        <input type="text" name="first-name" id="first-name" placeholder="First Name" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                    <div class="col-12 form-group middle-name-label">
                        <input type="text" name="middle-name" id="middle-name" placeholder="Middle Name" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                    <div class="col-12 form-group last-name-label">
                        <input type="text" name="last-name" id="last-name" placeholder="Last Name" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <select name="gender" id="gender" class="form-control" onInput="this.className = 'form-control'">
                            <option disabled selected value="0">Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 form-group">
                        <select name="civil-status" id="civil-status" class="form-control" onInput="this.className = 'form-control'">
                            <option disabled selected value="0">Civil Status</option>
                            <option value="1">Single</option>
                            <option value="2">Married</option>
                            <option value="3">Widow</option>
                            <option value="4">Widower</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5 form-group contact-label">
                        <input type="text" name="contact-number" id="contact_number" class="form-control" oninput="this.className = 'form-control'" placeholder="(09__)-___-____" data-slots="_">
                    </div>
                    <div class="col-12 form-group religion-label">
                        <input type="text" name="religion" id="religion" placeholder="Religion" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-2 lrn-label">
                <input type="number" name="lrn" id="lrn" placeholder="Learner's Reference Number (LRN)" class="form-control">
            </div>
        </div>
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
            <div class="col-12 col-md-9 form-group emergency-contact-label">
                <input type="text" name="emergency-contact-name" id="emergency-contact-name" class="form-control" placeholder="Parent / Guardian Name">
            </div>
            <div class="col-12 col-md-3 form-group contact-label">
                <input type="text" name="emergency-contact-number" id="emergency-contact-number" class="form-control" placeholder="(09__)-___-____" data-slots="_">
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
        @if (Auth::user()->role == 3)
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
        
        <!--Data Privacy Agreement Panel-->
        <div class="my-3 border-top text-center">
            <h3 class="mb-3 text-center">Data Privacy Agreement</h3>
            <div class="row" id="data-privacy-agreement-panel">
                <div class="col-12 alert alert-primary py-5">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english" role="tab" aria-controls="home" aria-selected="true">English</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="tagalog-tab" data-toggle="tab" href="#tagalog" role="tab" aria-controls="profile" aria-selected="false">Tagalog</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="cebuano-tab" data-toggle="tab" href="#cebuano" role="tab" aria-controls="contact" aria-selected="false">Cebuano</a>
                        </li>
                    </ul>
                    <div class="tab-content py-3" id="myTabContent">
                        <div class="tab-pane fade show active p-3" id="english" role="tabpanel" aria-labelledby="english-tab">
                            I hereby certify that the information given are true and correct to the best of my knowledge and I allow MLG College of Learning, Inc to use my details to create and/or update his/her learner profile in their school portal. The information herein shall be treated as confidential in compliance with the Data Privacy Act of 2012.
                        </div>
                        <div class="tab-pane fade p-3" id="tagalog" role="tabpanel" aria-labelledby="tagalog-tab">
                            Aking pinatutunayan na ang mga impormasyong akong ibinigay ay totoo at tama sa abot nga aking kaalaman at pinahihintulutan kung gamitin ng MLG College of Learning, Inc ang aking mga detalye upang sila ay makabuo o makapagwasto ng aking profile sa kanilang school portal. Ang mga impormasyon dito ay dapat ituring na compidensyal at naayon sa Data Privacy Act of 2012.
                        </div>
                        <div class="tab-pane fade p-3" id="cebuano" role="tabpanel" aria-labelledby="cebuano-tab">
                            Akong gikumpirmar nga ang mga impormasyon nga akong gipangbutang tinuod ug sakto basi sa tibook nako nga nahibaluan ug akong gitugutan ang MLG College of Learning, Inc nga gamiton ang akong mga detalye para makahimo o makatul-id sa akong profile sa ilahang school portal. Ang mga impormasyon nga akong gihatag dapat nga tratuhon isip sekreto isip pagsunod sa lagda sa Data Privacy Act of 2012.
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 col-md-4 offset-md-4 text-center">
                            <p class="font-weight-bold"><input type="checkbox" name="dpa-agree" id="dpa-agree" {{$profile->dpa_agreement != 0 ? 'checked' : ''}}> Yes, I Agree.</p>
                            <p class="font-weight-bold mt-3 text-danger text-center" id="dpa-agree-date"></p>
                            <input type="hidden" name="dpa-agreement-date" id="dpa-agreement-date">
                        </div>
                    </div>
                </div>
            </div>
        </div>

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