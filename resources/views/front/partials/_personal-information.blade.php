{{-- Personal Information --}}
<div class="row">
    <div class="col-12 col-md-4 mb-3" id="profile-pic-container">
        <img src="{{ asset('admin/img/empty-profile-img.png') }}" alt="Empty Profile Pic" style="width: 100%" class="img-responsive" id="profile-pic" data-toggle="modal" data-target="#selfieModal" onclick="openCam()" data-img="empty">
        <div class="overlay">
            <div class="capture-btn" data-toggle="modal" data-target="#selfieModal" onclick="openCam()">Click this to Capture Selfie</div>
        </div>
        <input type="hidden" name="applicant-img" class="img-tag" id="applicant-img">
    </div>
    <div class="col-12 col-md-8">
        <div class="row">
            <div class="col-12 form-group">
                <input type="text" name="first-name" id="first-name" placeholder="First Name" class="form-control" onInput="this.className = 'form-control'" >
            </div>
            <div class="col-12 form-group">
                <input type="text" name="middle-name" id="middle-name" placeholder="Middle Name" class="form-control" onInput="this.className = 'form-control'">
            </div>
            <div class="col-12 form-group">
                <input type="text" name="last-name" id="last-name" placeholder="Last Name" class="form-control" onInput="this.className = 'form-control'" >
            </div>
            <div class="col-12 col-md-3 form-group">
                <select name="gender" id="gender" class="form-control" onInput="this.className = 'form-control'" >
                    <option disabled selected>Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="col-12 col-md-4 form-group">
                <select name="civil-status" id="civil-status" class="form-control" onInput="this.className = 'form-control'" >
                    <option disabled selected>Civil Status</option>
                    <option value="1">Single</option>
                    <option value="2">Married</option>
                    <option value="3">Widow</option>
                    <option value="4">Widower</option>
                </select>
            </div>
            <div class="col-12 col-md-5 form-group">
                <input type="text" name="contact-number" id="contact_number" class="form-control" oninput="this.className = 'form-control'" placeholder="(09__)-___-____" data-slots="_" >
            </div>
            <div class="col-12 form-group">
                <input type="text" name="religion" id="religion" placeholder="Religion" class="form-control" onInput="this.className = 'form-control'" >
            </div>
        </div>
    </div>
</div>