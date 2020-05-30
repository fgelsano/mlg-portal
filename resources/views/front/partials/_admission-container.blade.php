{{-- Admission Form --}}
<div class="d-none mt-5" id="admission">
    <form action="" method="POST" id="admission-form" enctype="multipart/form-data">
        @csrf

        @include('front.partials._personal-information')
        
        @include('front.partials._emergency-contact')

        @include('front.partials._educational-history')

        @include('front.partials._lrn')

        @include('front.partials._course-details')

        @include('front.partials._file-uploads')

        {{-- Submit Button --}}
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4">
                <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
            </div>
        </div>

        {{-- Error Box --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="alert alert-danger d-none" id="error-box"></div>
            </div>
        </div>
    </form>
</div>