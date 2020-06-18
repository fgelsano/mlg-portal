<div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <form action="" id="editProfileForm">
        {{-- Personal Information --}}
        <div class="row py-3">
            <div class="col-12 col-md-4 mb-3" id="profile-pic-container">
                <div class="form-group ">
                    <input type="file" class="dropify" id="profile-pic" name="profilePic">
                </div>
                <div class="caption">
                    <p class="bg-danger text-white py-2 text-center">Upload Profile Picture</p>
                </div>
                <input type="hidden" name="applicant-img" class="img-tag" id="applicant-img">
            </div>
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 form-group">
                        <input type="text" name="first-name" id="first-name" placeholder="First Name" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" name="middle-name" id="middle-name" placeholder="Middle Name" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" name="last-name" id="last-name" placeholder="Last Name" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                    <div class="col-12 col-md-3 form-group">
                        <select name="gender" id="gender" class="form-control" onInput="this.className = 'form-control'">
                            <option disabled selected>Gender</option>
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 form-group">
                        <select name="civil-status" id="civil-status" class="form-control" onInput="this.className = 'form-control'">
                            <option disabled selected>Civil Status</option>
                            <option value="0">Single</option>
                            <option value="1">Married</option>
                            <option value="2">Widow</option>
                            <option value="3">Widower</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5 form-group">
                        <input type="text" name="contact-number" id="contact_number" class="form-control" oninput="this.className = 'form-control'" placeholder="(09__)-___-____" data-slots="_">
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" name="religion" id="religion" placeholder="Religion" class="form-control" onInput="this.className = 'form-control'">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-9 form-group">
                <input type="text" name="parent-guardian-name" id="parent-guardian-name" class="form-control" placeholder="Parent / Guardian Name">
            </div>
            <div class="col-12 col-md-3 form-group">
                <input type="text" name="parent-guardian-contact" id="parent-guardian-contact" class="form-control" placeholder="(09__)-___-____" data-slots="_">
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-9 mb-2">
                <input type="text" name="school-graduated" id="school-graduated" placeholder="School Graduated (Complete School Name)" class="form-control">
            </div>
            <div class="col-12 col-md-3 mb-2">
                <input type="number" name="year-graduated" id="year-graduated" placeholder="Year Grad (e.g. 2019)" class="form-control" maxlength="4">
            </div>
            <div class="col-12 mb-2">
                <textarea name="school-address" id="school-address" cols="30" rows="2" class="form-control" placeholder="School Address"></textarea>
            </div>
        </div>
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
    </form>
</div>