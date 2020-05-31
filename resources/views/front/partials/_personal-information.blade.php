{{-- Personal Information --}}
<div class="row">
    <div class="col-12 col-md-4 mb-3" id="profile-pic-container">
        <img src="{{ asset('storage/empty-profile-img.png') }}" alt="Empty Profile Pic" style="width: 100%" class="img-responsive" id="profile-pic" data-toggle="modal" data-target="#selfieModal" onclick="openCam()">
        <div class="overlay">
            <div class="capture-btn" data-toggle="modal" data-target="#selfieModal" onclick="openCam()">Capture Selfie</div>
        </div>
        <input type="hidden" name="applicant-img" class="img-tag">
    </div>
    <div class="col-12 col-md-8">
        <div class="row">
            <div class="col-12">
                <h4>Personal Information</h4>
            </div>
            <div class="col-12 form-group">
                <input type="text" name="first-name" id="first-name" placeholder="First Name" class="form-control">
            </div>
            <div class="col-12 form-group">
                <input type="text" name="middle-name" id="middle-name" placeholder="Middle Name" class="form-control">
            </div>
            <div class="col-12 form-group">
                <input type="text" name="last-name" id="last-name" placeholder="Last Name" class="form-control">
            </div>
            <div class="col-12 col-md-2 form-group">
                <select name="gender" id="gender" class="form-control">
                    <option disabled selected>Gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>
            <div class="col-12 col-md-2 form-group">
                <select name="civil-status" id="civil-status" class="form-control">
                    <option disabled selected>Civil Status</option>
                    <option value="0">Single</option>
                    <option value="1">Married</option>
                    <option value="2">Widow</option>
                    <option value="3">Widower</option>
                </select>
            </div>
            <div class="col-12 col-md-8 form-group">
                <input type="text" name="religion" id="religion" placeholder="Religion" class="form-control">
            </div>
            <div class="col-12">
                <label for="">Physical Address</label>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <input type="text" name="purok" id="purok" placeholder="Purok" class="form-control">
            </div>
            <div class="col-12 col-md-2 mb-2">
                <input type="text" name="sitio" id="sitio" placeholder="Sitio" class="form-control">
            </div>
            <div class="col-12 col-md-8 mb-2">
                <input type="text" name="street-barangay" id="street-barangay" placeholder="Street / Barangay" class="form-control">
            </div>
            <div class="col-12 col-md-4 mb-2">
                <input type="text" name="municipality" id="municipality" placeholder="Municipality" class="form-control">
            </div>
            <div class="col-12 col-md-4 mb-2">
                <input type="text" name="province" id="province" placeholder="Province" class="form-control">
            </div>
            <div class="col-12 col-md-2 mb-2">
                <input type="text" name="zip-code" id="zip-code" placeholder="Zip Code" class="form-control">
            </div>
        </div>
    </div>
</div>